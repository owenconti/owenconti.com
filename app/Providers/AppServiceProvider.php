<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/dashboard';

    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $siteTitle = 'Owen Conti';
        $description = 'Owen Conti\'s personal blog including articles on Laravel, PHP, React, Vue, and MySQL.';

        seo()
            ->site($siteTitle)
            ->title(
                default: $siteTitle,
                modify: fn (string $title) => "{$title} | {$siteTitle}"
            )
            ->description($description)
            ->withUrl()
            ->twitterSite('owenconti')
            ->image('https://snaps-proxy.owenconti.workers.dev?w=1200&h=632&dpi=2&url=https://owenconti.com/og-image/?data='.base64_encode(json_encode(['title' => 'Owen Conti', 'date' => now()->format('M d, Y')])));

        $this->bootRoute();
    }

    public function bootRoute(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });


    }
}
