---
slug: posts/laravel-request-logger-snippet
title: 'Laravel Request Logger Snippet'
type: post
category_slug: laravel
excerpt: 'Here''s a quick snippet to get HTTP request logging setup quickly in Laravel.'
updated_at: 1589851613
created_at: 1589851613
---

Here's a quick snippet to get HTTP request logging setup quickly in Laravel:

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class RequestLogger
{
    /** @var int */
    private $startTime;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->startTime = round(microtime(true) * 1000);

        return $next($request);
    }

    public function terminate($request, $response)
    {
        $user = $request->user();
        $userId = $user ? $user->id : 0;

        $token = $user && $user->token() ? $user->token()->id : null;

        $method = strtoupper($request->getMethod());

        $statusCode = $response->getStatusCode();

        $uri = $request->getPathInfo();

        $bodyAsJson = json_encode($request->except(['password', 'password_confirmation']));

        $contentType = $response->headers->get('Content-Type');

        $runTime = round(microtime(true) * 1000) - $this->startTime;

        Log::info("{$statusCode} {$runTime}ms {$method} {$contentType} {$uri} | User: {$userId} | Token: {$token} | {$bodyAsJson}");
    }
}
```

Because both the `handle` and `terminate` methods access the `$this->startTime` variable, we need to make sure we receive the same instance of the middleware in both methods. To do this, you need to register the middleware as a singleton in the `boot` method of your `AppServiceProvider`:

```php
<?php

public function boot()
{
	$this->app->singleton(\App\Http\Middleware\RequestLogger::class);
}
```

Don't forget to add the middleware to the `$middleware` array in `App\Http\Kernel.php`!

Credit to [https://github.com/spatie/laravel-http-logger](https://github.com/spatie/laravel-http-logger) for some of the lines.