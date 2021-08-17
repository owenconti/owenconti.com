---
slug: posts/setting-up-php-codesniffer-for-a-laravel-application
title: 'Setting Up PHP CodeSniffer for a Laravel Application'
type: post
category_slug: laravel
excerpt: 'Here''s how you can quickly get started with linting your PHP code using the CodeSniffer library.'
updated_at: 1589852392
created_at: 1589852392
---

Here's how you can quickly get started with linting your PHP code using the CodeSniffer library.

First, install the dependency:

```bash
composer require "squizlabs/php_codesniffer=*"
```

Then, create a file at the root of your repo: `phpcs.xml`

```xml
<?xml version="1.0"?>
<ruleset name="Standard">
    <rule ref="PSR2">
        <exclude name="PSR1.Methods.CamelCapsMethodName"/>
    </rule>
</ruleset>
```

This file tells CodeSniffer which ruleset and rules you want to use. The above will use the PSR2 ruleset, while excluding the `CamelCapsMethodName` rule (I prefer the `it_does_something` method name formatting for tests).