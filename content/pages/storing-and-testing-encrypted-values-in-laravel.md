---
slug: posts/storing-and-testing-encrypted-values-in-laravel
title: 'Storing and testing encrypted values in Laravel'
type: post
category_slug: laravel
excerpt: 'A couple of open source packages makes storing and testing encrypted database values in Laravel a breeze.'
video: C81SNv1t6qk
updated_at: 1610142070
created_at: 1610142070
---

When writing web applications, there are times where you'll need to store an encrypted value in the database. One example might be a secret token that you want extra security around in case your data is exposed. Furthermore, once you've stored the encrypted values, you'll probably want to test that they're actually stored encrypted instead of in plaintext.

## Storing encrypted values

There's an open source package available written by [Jeff Sagal](https://twitter.com/sagalbot), which will automatically encrypt values for specified database columns: [Encryptable](https://github.com/sagalbot/encryptable). Let's run through how you can use it.

Install the composer package:

* `composer require sagalbot/encryptable`

Ensure you have an application key generated, skip this if you already have a key set in your `.env` file:

* `php artisan key:generate`

Add the `Encryptable` trait to the model you want to encrypt a column on, and then add an `$encryptable` array to the model with the list of columns you want to store encrypted:

```php
<?php

...

use Sagalbot\Encryptable\Encryptable;

class User extends Authenticatable
{
    use Encryptable;

    protected $encryptable = ['secret_token'];

    ...
}
```

Now whenever your model is saved with a `secret_token` value set, the `secret_token` value will be encrypted before being written to the database. When pulling the model from the database, the encrypted value will only be decrypted when either the property is accessed directly or through a `toArray` or `toJson` function.

```php
<?php

// Store value
$user = User::create([
  'secret_token' => 'abc123'
]);

// Access directly
$user->secret_token // outputs 'abc123'

// Access via toArray()/toJson()
$user->toArray() // outputs [ ..., 'secret_token' => 'abc123' ]
```

Remember that if you dump the model without accessing the property, the value will be output as encrypted.

## Testing encrypted values

Now that we have our value stored encrypted, we can write a test to confirm its stored encrypted and not in plaintext.

For this, we're going to use a package I wrote called [Laravel Assert Encrypted](https://github.com/ohseesoftware/laravel-assert-encrypted). This package exposes a new assertion method for your tests to assert a database has an encrypted value in a specified column.

First, install the package:

* `composer require ohseesoftware/laravel-assert-encrypted`

Add the `AssertEncrypted` trait from the package to your test class:

```php
<?php

namespace Tests;

use OhSeeSoftware\LaravelAssertEncrypted\Traits\AssertEncrypted;

class SomeTest extends TestCase
{
    use AssertEncrypted;
```

Use the new `assertEncrypted` method to test your encrypted value:

```php
<?php

/** @test */
public function it_stores_users_secrets()
{
    // Given
    $user = factory(User::class)->create([
        'secret_token' => encrypt('api-key')
    ]);

    // Then
    $this->assertEncrypted('users', ['id' => $user->id], [
        'secret_token' => 'api-key'
    ]);
}
```

The first argument is the table to query against, the second argument is the `where` data that should be used to find the row in the table, and the third argument is the encrypted data you're expecting.