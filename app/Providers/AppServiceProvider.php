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
            ->twitterSite('owenconti');
    }
}
