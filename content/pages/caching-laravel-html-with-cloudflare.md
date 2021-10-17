---
slug: posts/caching-laravel-html-with-cloudflare
title: 'Caching Laravel HTML With Cloudflare'
type: post
category_slug: laravel
excerpt: 'Laravel''s default setup prevents Cloudflare from caching HTML responses.'
updated_at: 2021-08-17
created_at: 2021-08-17
---

If you're serving any sort of content site with Laravel, you've probably looked into setting up caching for your page responses. For this site [owenconti.com](owenconti.com), I'm letting Cloudflare handle the caching for me. I do this by setting up a Page Rule to "cache everything":

![Cloudflare page rule to cache everything](/assets/cloudflare-page-rule-for-caching-everything.png)

The above page rule will cache everything that the Laravel app returns. However, Cloudflare does not cache responses that modify cookies. By default, Laravel's `web` middleware is setup to handle sessions for you.

## Removing Session Middleware

Since this site is purely for anonymous visitors, I'll never need to use sessions or cookies of any sort. Because of that, I am able to remove all of the session and cookie middlewares from the `web` middleware group:

```php
// app\Http\Kernel.php

<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middleware = [
      // ...
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class, // [tl! remove]
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class, // [tl! remove]
            \Illuminate\Session\Middleware\StartSession::class, // [tl! remove]
            \Illuminate\Session\Middleware\AuthenticateSession::class, // [tl! remove]
            \Illuminate\View\Middleware\ShareErrorsFromSession::class, // [tl! remove]
            \App\Http\Middleware\VerifyCsrfToken::class, // [tl! remove]
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];
```

After removing the session and cookie middlewares, Cloudflare will start to properly cache HTML responses from the Laravel application.

You can validate this by checking the response headers of the HTML response:

```php
cache-control: public, max-age=3600, s-maxage=86400
cf-cache-status: HIT // [tl! highlight]
cf-ray: 6803f1964956e472-SEA
```