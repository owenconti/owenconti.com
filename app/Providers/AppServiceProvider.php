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
        $description = 'Web programming articles including tips, tricks, and tutorials on Laravel, PHP, React, Vue, MySQL and more.';

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
