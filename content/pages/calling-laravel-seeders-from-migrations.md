---
slug: posts/calling-laravel-seeders-from-migrations
title: 'Calling Laravel Seeders from Migrations'
type: post
category_slug: laravel
excerpt: 'Calling seeders from migrations allows you to ensure data referenced by code always exists in your database.'
video: s_pKAgYarfI
updated_at: 1590069139
created_at: 1590069139
---

Seeders in the [Laravel framework](https://laravel.com/) allow you to populate your database with fake/seeded data. As you probably know, you can call a seeder from within a migration using Laravel. This technique is used when you have data in your database that is critical to your codebase, like permissions. Permissions are referenced in your codebase, so they must exist in your database at all times as well.

Here's an example of how you would call a seeder from a migration:

```php
<?php

// inside migration file
public function up()
{
    // Create a table here

    // Call seeder
    Artisan::call('db:seed', [
        '--class' => 'SampleDataSeeder',
    ]);
}
```

Whenever your application is migrated and the above migration is run, the `SampleDataSeeder` will also run.

🚨🚨 There's a catch! 🚨🚨

This will work fine in our local environment, however when we deploy this to production, the seeder will fail to run. Assuming our `APP_ENV` environment variable value is `PRODUCTION`, we need to tell Laravel that we acknowledge we are running this in production:

```bash
php artisan migration --force
```

We **also** need to do the same thing when running the seeder from within the migration. When it comes down to it, all we're doing is invoking another Artisan command, which has its own set of flags. So to make sure our seeder works in production, pass the `--force` flag when calling the seeder:

```php
<?php

// inside migration file
public function up()
{
    // Create a table here

    // Call seeder
    Artisan::call('db:seed', [
        '--class' => 'SampleDataSeeder',
        '--force' => true // <--- add this line
    ]);
}
```