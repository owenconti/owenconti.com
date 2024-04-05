<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Page;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:sitemap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $sitemap = Sitemap::create()
            ->add(
                Url::create('/')
                    ->setLastModificationDate(now())
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                    ->setPriority(1.0)
            )
            ->add(
                Url::create('/articles')
                    ->setLastModificationDate(now())
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                    ->setPriority(0.9)
            );

        Page::all()->each(function (Page $page) use ($sitemap) {
            $sitemap->add(
                Url::create($page->url)
                    ->setLastModificationDate($page->updated_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
            );
        });

        Category::all()->each(function (Category $category) use ($sitemap) {
            $sitemap->add(
                Url::create($category->url)
                    ->setLastModificationDate($category->pages()->orderBy('updated_at', 'desc')->first()->updated_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
            );
        });

        $sitemap->writeToFile(base_path('public/sitemap.xml'));
    }
}
