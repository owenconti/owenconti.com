---
slug: posts/improve-performance-laravel-feature-tests-using-mysql-instead-of-sqlite-or-memory-databases
title: 'Improve the Performance of Laravel Feature Tests using MySQL Instead of SQLite or Memory Databases'
type: post
category_slug: laravel
excerpt: 'Many people use an in-memory SQLite database when running their Laravel feature tests. If you''re doing this, chances are you can improve the runtime of your Laravel test suite.'
updated_at: 1590069318
created_at: 1590069318
---

Laravel defaults to using an in-memory SQLite database for testing. Using this type of database has some advantages over a traditional MySQL database such as less configuration, your tests "just work", they run faster than a traditional database, etc. However, there are also some disadvantages as well:

* Some schema changes are not supported in SQLite but are supported in MySQL and Postgres, which means you need to work around them in your migrations so that they run properly when testing and when in production.
* Some database features are not supported in SQLite such as full-text searching
* You can never fully trust SQLite will work exactly how a MySQL/Postgres database works in production
* When using the `RefreshDatabase` trait that comes out of the box with Laravel, a SQLite test suite can actually be much slower than MySQL

## Real world example

I'm working on a project where we just transitioned from an in-memory SQLite test suite to a MySQL test suite. At the time of the transition, we had 52 migrations in the project. A full test suite (426 tests) with the in-memory driver took between **1.5 minutes to 3 minutes**, depending on the machine running the tests.

After the transition, the full test suite (with more tests too, up to 495 at the time of writing this post), now runs between **~14 seconds to ~20 seconds**, depending on the machine running the tests.

```php
PHPUnit 8.5.3 by Sebastian Bergmann and contributors.

...............................................................  63 / 495 ( 12%)
............................................................... 126 / 495 ( 25%)
............................................................... 189 / 495 ( 38%)
............................................................... 252 / 495 ( 50%)
............................................................... 315 / 495 ( 63%)
............................................................... 378 / 495 ( 76%)
............................................................... 441 / 495 ( 89%)
......................................................          495 / 495 (100%)

Time: 14.49 seconds, Memory: 88.50 MB
```

## How can testing against a real MySQL instance be faster than in-memory?

The key is in the `RefreshDatabase` trait. When using the trait with an in-memory database, Laravel will re-migrate the database with each test run. So as an example, if your migrations take 1.5 seconds to run, each test using the `RefreshDatabase` trait in your suite will take at least 1.5 seconds. Some basic math for a test suite with 400 tests:

`400 * 1.5 = 600 seconds = 10 minutes!!`

**Ouch.**

As fast as in-memory is, the root problem is that you're running migrations over and over again. This is where `RefreshDatabase` shines.

Instead of running your migrations from scratch for each test, the trait keeps track once your migrations have been run for the first time. From that point forward it uses database transactions to rollback the database after each test, which resets the database to the state it was in at the beginning of the test (migrated but with no data).

There is a small caveat that you need to be aware of. When the database rolls back the transaction, any auto-incremented keys are not rolled back. Databases do this to prevent primary key collisions when using transactions.

So if you're asserting that a database includes a hard coded ID, you'll need to update your assertions because you can no longer guarantee that auto-increment fields will start at 1.

We made a simple helper class to use for our tests:

```php
<?php

namespace Tests\Helpers;

use Illuminate\Support\Facades\DB;

class AutoIncrement
{
    public static function nextId(string $modelClass)
    {
        $model = resolve($modelClass);

        if (!$model->getIncrementing()) {
            throw new \Exception("{$model->getTable()} does not use an incrementing key.");
        }

        $result = DB::select("SHOW TABLE STATUS LIKE '{$model->getTable()}'");
        return $result[0]->Auto_increment;
    }
}
```

Usage of this class looks like this:

```php
<?php

// Before we make our Post, determine the next ID
$nextId = AutoIncrement::nextId(Post::class);

// Call the endpoint to create a new Post here..

// Assert the Post was created with the correct ID
$this->assertDatabaseHas('posts', [
    'id' => $nextId,
    'title' => 'New Post',
]);
```

## Switching to MySQL database for testing

There's two steps to switching to using MySQL for your tests:

1. Create a new database to use for tests. You probably don't want to use the same database for local development as you do for testing because each time you run a test, the database will be reset.
2. Update `phpunit.xml` to use the MySQL connection and new database:

```xml
<server name="DB_CONNECTION" value="mysql"/>
<server name="DB_DATABASE" value="your_test_database"/>
```

Apart from those two changes, you'll have to update any tests that assert a hard coded auto-incrementing ID as described above!
