---
slug: posts/2020-01-16.using-static-http-redirects-in-statamic-v3
title: 'Using Static HTTP Redirects in Statamic v3'
type: post
category_slug: statamic
excerpt: 'Statamic includes a built-in mechanism for setting up 301 and 302 HTTP redirects.'
updated_at: 1589853831
created_at: 1589853831
---

Statamic includes a built-in mechanism for setting up 301 and 302 HTTP redirects. If you need to setup permanent or semi-permanent redirects (from within config files), you can do so in the `config/statamic/routes.php` file.

To setup permanent (301 response code) redirects, add the routes to a `redirects` key:

```php
<?php

'redirect' => [
    '/old' => 'https://some-external-url.com',
    '/old-slug' => '/new-slug'
],
```

However, if you want to setup a temporary (Statamic calls in "vanity") redirect (302 response code), add the routes to a `vanity` key:

```php
<?php

'vanity' => [
    '/temp-url' => '/some-new-temp-url',
],
```

If you're looking to setup dynamic redirects that you can manage from within the CMS, check out my post on [Setting up dynamic HTTP redirects with Statamic v3](/posts/setting-up-http-redirects-with-statamic-v3/).