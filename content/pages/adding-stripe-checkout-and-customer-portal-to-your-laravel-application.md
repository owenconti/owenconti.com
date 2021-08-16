---
slug: posts/adding-stripe-checkout-and-customer-portal-to-your-laravel-application
title: 'Adding Stripe Checkout and Customer Portal to your Laravel application'
type: post
category_slug: laravel
excerpt: 'Learn how to add Stripe''s Checkout and Customer Portal products to your Laravel application using Laravel Cashier.'
video: RRCHnpqdsAs
updated_at: 2021-01-14
created_at: 2021-01-14
---

Here's a quick overview of how you can add [Stripe Checkout](https://stripe.com/docs/payments/checkout) and [Stripe Customer Portal](https://stripe.com/docs/billing/subscriptions/customer-portal) to your Laravel application via [Laravel Cashier](https://laravel.com/docs/8.x/billing#installation).

> This guide assumes you have a Stripe dev account setup and access to your Stripe Key and Secret. You should also have your products and pricing configure in Stripe. You will need at least one Price ID.

### Resources

* [GitHub repository that was used in the YouTube video](https://github.com/owenconti/laravel-stripe-checkout-billing-portal)
* [YouTube video setting this up from scratch (with a User billable entity, not Team)](https://www.youtube.com/watch?v=RRCHnpqdsAs)
* [Laravel Cashier docs pull request to add Checkout and Customer Portal support](https://github.com/laravel/docs/pull/6465/files)
* [Laravel Cashier official docs](https://laravel.com/docs/8.x/billing)

## Considerations

First, you need to figure out which entity in your application will be considered the billable entity. For example, if you have an application with teams where each team signs up and pays for a number of seats, then your `Team` model will be your billable entity. However, if your application has users which sign up and pay for themselves, then your `User` model will be your billable entity.

## Environment variables

We need to setup some environment variables for Laravel Cashier to pass along to stripe. You only need to set `CASHIER_MODEL` if your billable model is not `App\Models\User`.

```bash
CASHIER_MODEL=App\Models\Team
STRIPE_KEY=XXXXXXX
STRIPE_SECRET=XXXXXXX
```

## Package installation

As of Feb 9, 2020, the released version of Laravel Cashier supports Stripe checkout. You can install Laravel Cashier with:

```bash
composer require laravel/cashier
```

On the frontend, we will be using the Stripe JS SDK, so make sure to include that on your page somewhere:

```html
<script src="https://js.stripe.com/v3/" defer></script>
```

## Migrations

I recommend publishing Cashier's migrations into your local migrations directory, so that you have full control over them:

```bash
php artisan vendor:publish --tag="cashier-migrations"
```

If your billable model is not `User`, make sure to change the table in the `CreateCustomerColumns` migration we just published to the table that corresponds to your billable model.

```php
<?php

// I changed 'users' to 'teams'

Schema::table('teams', function (Blueprint $table) {
    $table->string('stripe_id')->nullable()->index();
    $table->string('card_brand')->nullable();
    $table->string('card_last_four', 4)->nullable();
    $table->timestamp('trial_ends_at')->nullable();
});
```

I also had to change the `CreateSubscriptionsTable` migration to reference my billable entity's table:

```php
<?php

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('team_id'); // I changed this from `user_id`
            $table->string('name');
            $table->string('stripe_id');
            $table->string('stripe_status');
            $table->string('stripe_plan')->nullable();
            $table->integer('quantity')->nullable();
            $table->timestamp('trial_ends_at')->nullable();
            $table->timestamp('ends_at')->nullable();
            $table->timestamps();

            $table->index(['team_id', 'stripe_status']); // I changed this from `user_id`
        });
    }
}
```

Since we published Cashier's migrations, we should also tell Cashier not to run its default migrations. Add this to your `AppServiceProvider.register` method:

```php
<?php

use Laravel\Cashier\Cashier;

/**
 * Register any application services.
 *
 * @return void
 */
public function register()
{
    Cashier::ignoreMigrations();
}
```

## Model setup

Next, we need to configure our billable model. In my case, the billable model is `Team`. Add the `Billable` trait to your model:

```php
<?php

namespace App\Models;

use Laravel\Cashier\Billable;

class Team extends Model
{
    use Billable;
}
```

## Redirect to subscription page

If your user is logged in but doesn't have an active subscription, we need to redirect them to a page asking them to subscribe. The following examples will be specific to Inertia, but the concepts can be used on any Laravel stack.

### Middleware

We're going to add a middleware which we will use to confirm the user has an active subscription. You can pass the name of the subscription into `subscribed()`.

```php
<?php

namespace App\Http\Middleware;

use Closure;

class BillingMiddleware
{
    public function handle($request, Closure $next)
    {
        $user = $request->user();

        if ($user && !$user->currentTeam->subscribed('default')) {
            return redirect('subscription');
        }

        return $next($request);
    }
}
```

We then need to add the new middleware to our HTTP Kernel:

```php
<?php

protected $routeMiddleware = [
    // ...
    'billing' => BillingMiddleware::class
];
```

### Controller

Create the controller which will start a new Stripe Checkout session, and then return the Checkout Session ID to the UI.

```php
<?php

namespace App\Http\Controllers\Teams;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ManageSubscriptionController extends Controller
{
    public function __invoke(Request $request)
    {
        $checkout = $request->user()->currentTeam->newSubscription('default', config('stripe.price_id'))->checkout();

        return Inertia::render('Teams/ManageSubscription', [
            'stripeKey' => config('cashier.key'),
            'sessionId' => $checkout->id
        ]);
    }
}
```

You'll notice in the above example that I am referencing `config('stripe.price_id')`. This comes from the Stripe Dashboard where you configure your products and pricing. I'll leave it up to you to figure out how you want to determine this value. Most people store their plans/pricing in a Laravel config file and then pull them from there based on what the user selected from your UI.

Don't forget to add the route for the above controller:

```php
<?php

Route::get('/subscription', ManageSubscriptionController::class)->name('subscription');
```

Note that the name of the route above matches the name of the route we are redirecting to in the `BillingMiddleware`.

### Inertia View

Here's my full Inertia (Vue) component to render the subscription page. This probably won't be copy/pastable, but hopefully it can guide you in the right direction.

```vue
<template>
  <page :title="title">
    <div class="py-10 mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="text-center">
        <h2 class="text-2xl font-bold">
          Hold up! You need an active subscription first.
        </h2>
        <jet-button class="mt-4" @click.native="checkout">
          Head to the checkout page
        </jet-button>
      </div>
    </div>
  </page>
</template>

<script>
import Page from '../../Layouts/Page';
import AppLayout from '../../Layouts/AppLayout';
import JetButton from '../../Jetstream/Button';
export default {
  layout: AppLayout,
  components: {
    Page,
    JetButton,
  },
  props: {
    stripeKey: {
      type: String,
      required: true,
    },
    sessionId: {
      type: String,
      required: true,
    },
  },
  computed: {
    title() {
      return 'Manage Subscription';
    },
  },
  methods: {
    checkout() {
      window
        .Stripe(this.stripeKey)
        .redirectToCheckout({
          sessionId: this.sessionId,
        })
        .then(function (result) {
          console.error('result', result);
        });
    },
  },
};
</script>
```

The key to the above component is the `checkout` method which we call via a button (user input). The `checkout` method is called with our public Stripe Key (passed from the backend), and the `sessionId` which is the Stripe Checkout Session ID (also passed from the backend).

From here, Laravel Cashier will take care of updating your database tables with the accurate subscription info, all via webhooks. You will need to make sure you've configured webhooks on the Stripe Dashboard though. The endpoint that Laravel Cashier automatically registers is: `/stripe/webhook`.

## Billing portal endpoint

The Billing Portal is the easiest part of this whole process. All you need to do is register a new endpoint which redirects to the billing portal.

```php
<?php

namespace App\Http\Controllers\Teams;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BillingPortalController extends Controller
{
    public function __invoke(Request $request)
    {
        return $request->user()->currentTeam->redirectToBillingPortal();
    }
}
```

And then define the route:

```php
<?php

Route::get('/billing-portal', BillingPortalController::class);
```

And then link to that new route from wherever you want in your application. In my Jetstream application, I've added it to the dropdown menu:

```vue
<jet-dropdown-link href="/billing-portal" :external="true">
  Billing Portal
</jet-dropdown-link>
```

## Summary

There are a bunch of steps involved, but mostly its following the Laravel Cashier documentation. You can check out the Laravel docs repo on GitHub to see the documentation changes made for the Billing Portal: [https://github.com/laravel/docs/compare/stripe-checkout...master](https://github.com/laravel/docs/compare/stripe-checkout...master)