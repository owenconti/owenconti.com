<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $siteTitle = 'Owen Conti';
        $description = 'Owen Conti\'s personal blog including articles on Laravel, PHP, React, Vue, and MySQL.';

        seo()
            ->site("{$siteTitle} - {$description}")
            ->title(
                default: $siteTitle,
                modify: fn (string $title) => "{$title} | {$siteTitle}"
            )
            ->description($description)
            ->withUrl()
            ->twitterSite('owenconti')
            ->image('https://snaps-proxy.owenconti.workers.dev?w=1200&h=632&dpi=2&url=https://owenconti.com/og-image/?data='.base64_encode(json_encode(['title' => 'Owen Conti'])));
    }
}
