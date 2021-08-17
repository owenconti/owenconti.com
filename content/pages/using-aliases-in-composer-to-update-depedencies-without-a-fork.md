---
slug: posts/using-aliases-in-composer-to-update-depedencies-without-a-fork
title: 'Using Aliases in Composer to Update Dependencies without a Fork'
type: post
category_slug: php
excerpt: 'One of the major pain points of updating dependencies is the strict version requirements developers place on their packages.'
updated_at: 1589855880
created_at: 1589855880
---

Many PHP package developers place strict version requirements on their packages. For example, the `spatie/laravel-permission` package has:

```php
"require": {
    "php" : "^7.2.5",
    "illuminate/auth": "^5.8|^6.0|^7.0",
    "illuminate/container": "^5.8|^6.0|^7.0",
    "illuminate/contracts": "^5.8|^6.0|^7.0",
    "illuminate/database": "^5.8|^6.0|^7.0"
},
```

Which means it requires the version of the `illuminate` packages to be at least `5.8` but not above or equal to `8.0`. So when Laravel 8.0 comes out, the developers of the package will need to update their composer version requirements before users can update to Laravel 8.0\.

They do this to ensure their package works with the new version, which is fair enough if the package developers are active and quick to update their packages.

However, when you use a package that doesn't have an active maintainer, or the maintainer is not quick to update their package, you're stuck with not being able to update your dependencies.

### A quick fix

Composer provides a quick work around that allows you to update your dependencies without Composer complaining about version mismatches. You can use **aliases** to tell Composer to think a dependency is actually a different version than what is being installed. Here's an example:

```php
"laravel/framework": "8.x-dev as 7.6.1",
```

The above will instruct Composer to pull down the `8.x-dev` branch from Github but pretend that it is actually version `7.6.1`. This will allow Composer to install the dependency even though other dependencies may explicitly require version 7.x of `laravel/framework`.

### Not a perfect solution

It should be noted that this solution can lead to issue of its own. Even though Composer will install the dependencies correctly, the dependencies may no longer work well together. You should ensure you have adequate tests setup if you use aliases.

You can read more about aliases on the Composer website: [https://getcomposer.org/doc/articles/aliases.md](https://getcomposer.org/doc/articles/aliases.md)
