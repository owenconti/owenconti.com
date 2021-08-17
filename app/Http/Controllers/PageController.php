<?php

namespace App\Http\Controllers;

use App\VaporAssetWrapping;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Environment;
use League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkExtension;
use Torchlight\Commonmark\TorchlightExtension;

class PageController
{
    public function __invoke(string $page)
    {
        if (str_starts_with($page, '_')) {
            abort(404);
        }

        $view = config('pages.views.path').$page;

        if (view()->exists($view)) {
            return view($view);
        }

        if ($model = config('pages.model')::find($page)) {
            seo()
                ->title($model->title)
                ->description($model->excerpt ?? Str::limit($model->content, 100))
                ->image('https://snaps-proxy.owenconti.workers.dev?w=1200&h=632&dpi=2&url=https://owenconti.com/og-image/?data='.base64_encode(json_encode([
                    'title' => $model->title,
                    'excerpt' => $model->excerpt,
                    'category' => $model->category->title,
                    'date' => $model->created_at->format('M d, Y'),
                ])));

            $content = $this->generateContent($model->content);

            View::share('page', $model);

            return view(config('pages.views.markdown'), [
                'content' => $content,
            ]);
        }

        abort(404);
    }

    private function generateContent(string $content): string
    {
        $environment = Environment::createCommonMarkEnvironment()
            ->addExtension(new TorchlightExtension())
            ->addExtension(new VaporAssetWrapping())
            ->addExtension(new HeadingPermalinkExtension());

        $environment->mergeConfig([
            'heading_permalink' => [
                'symbol' => '#',
            ],
        ]);

        $commonMarkConverter = new CommonMarkConverter(environment: $environment);

        return $commonMarkConverter->convertToHtml($content);
    }
}
