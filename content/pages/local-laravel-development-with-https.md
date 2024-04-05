---
slug: posts/local-laravel-development-with-https
title: 'Local Laravel Development With HTTPS'
type: post
category_slug: laravel
excerpt: "Setting up HTTPS for your local Laravel development environment is easier than you may think."
updated_at: 2024-04-05
created_at: 2024-04-05
---

A couple years ago, I was working on a Laravel application that provided Google SSO authentication. However, I ran into a problem when setting up my local redirect URL within the Google UI: they only allow HTTPS URLs. This was a problem because my local development environment was running on HTTP. I needed a way to run my local Laravel application on HTTPS.

## Laravel Valet

If you're running Laravel Valet, setting up HTTPS is as a simple as running the following command:

```bash
valet secure
```

After that, update your `APP_URL` in your `.env` file to use `https`, and that's it!

## Laravel Sail

Last year I started using Laravel Sail for my local development environment due to working on multiple projects with different dependency versions (PHP, MySQL, Postgres, etc). One of the first problems I ran into with Laravel Sail was getting HTTPS to work locally. Thankfully, Caddy makes this easy to do.

### Prerequisites

Let's take a second to review how Laravel Sail serves apps. By default, the `docker-compose.yml` file uses the `APP_PORT` environment variable as the port to serve the app on. So for example, if your `APP_PORT=1005` then your app will be served on `http://127.0.0.1:1005` by Laravel Sail.

You'll need to have Caddy installed on your machine. You can do so via Homebrew:

```bash
brew install caddy
```

If you don't want to use Homebrew, you can [follow the instructions on the Caddy site to build from scratch](https://caddyserver.com/docs/install#install).

### Setting Up HTTPS

To enable HTTPS for the app running on that `1005` port, we set up Caddy to reverse proxy from a custom domain to the app running on that port. Here's what the `Caddyfile` would look like:

```yml
my-app.localhost {
    reverse_proxy 127.0.0.1:1005
}
```

Then you just need to start Caddy (make sure you don't have `nginx` or any other web server running on port 80) with: `caddy run`. This will start Caddy in the foreground of your terminal. You should now be able to load `https://my-app.localhost` in your browser. It'll take a second for it to load because Caddy will generate a self-signed certificate for the domain, but you should see your Laravel app running on HTTPS!

If you want to run Caddy in the background, you can use the following command to run Caddy after configuring the `Caddyfile`:

```bash
caddy start
```

### Caddyfile location

Feel free to put your `Caddyfile` wherever you like. I put mine in the `~/development` directory. You just need to make sure you run Caddy from the directory where the `Caddyfile` is located or you provide the path to the config when you run Caddy.

## Laravel Artisan Serve

If you typically use the `php artisan serve` command to serve your Laravel app locally, you can still run it over HTTPS with Caddy. Add a single entry to the Caddy file using the `8000` port:

```yml
laravel.localhost {
    reverse_proxy 127.0.0.1:8000
}
```

This will allow you to start your Laravel app with `php artisan serve` but have it served over HTTPS.

## HTTPS for Vite

This part is not necessary, but if you also want to run Vite over HTTPS, you can do so via the `vite-plugin-mkcert` package. This package will generate a self-signed certificate for your Vite server to run on HTTPS. Here's how you can set it up:

```bash
npm i -D vite-plugin-mkcert
```

Then update your `vite.config.js` file to use the plugin:

```js
import mkcert from 'vite-plugin-mkcert';

export default defineConfig({
  plugins: [mkcert()]
})
```

## Troubleshooting

One common problem you may run into is with Laravel knowing that it is being served over HTTPS instead of HTTP. Since Caddy is terminating the HTTPS connection for us, Laravel is technically still being served via HTTP. The fix for this is to set your `TrustProxies` middleware to trust the Caddy IP address. Locally, I usually just set this to `*`:

```php
return Application::configure(basePath: dirname(__DIR__))
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->trustProxies(at: '*');
    });
```
