---
slug: posts/how-to-fix-cannot-declare-class-because-the-name-is-already-in-use-error-in-laravel-php
title: 'How to fix "cannot declare class because the name is already in use" error in Laravel/PHP'
type: post
category_slug: laravel
excerpt: 'This error can happen when you have two of the same class names declared in the same namespace.'
updated_at: 1608440240
created_at: 1608440240
---

> "cannot declare class because the name is already in use"

This can be an annoying error to track down.

## Quick fix

The first thing to look for is that you do not have more than one of the same class defined in the namespace.

If that doesn't solve your problem, then you need to start hunting. Make sure you clear your compiled cache too:

```bash
php artisan optimize:clear
composer dump-autoload
```

## Checking vendor files

In my case, I had renamed a Laravel migration file that was published from Laravel Cashier. This turned out to be a problem. Here's how it breaks down:

```bash
# Laravel Cashier includes this migration file:
vendor/laravel/cashier/database/migrations/2019_05_03_000001_create_customer_columns.php

# I opted to publish the migrations to my codebase
database/migrations/2019_05_03_000001_create_customer_columns.php

# I then renamed the migration file so I could change the order relative to my other migrations:
database/migrations/2020_10_01_000001_create_customer_columns.php
```

So now we have an issue. Both migration files (my own codebase, and Laravel Cashier's version), have different file names, but they both still have the same _class name_: `CreateCustomerColumns`.

## The fix?

You have two options:

* Don't rename the original migration files
* If you must rename the migration, also make sure to rename the class too!