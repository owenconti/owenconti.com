<?php

namespace App\Http\Controllers;

use App\VaporAssetWrapping;
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
                ->description($model->excerpt ?? Str::limit($model->content, 100));

            $content = $this->generateContent($model->content);

            return view(config('pages.views.markdown'), [
                'page' => $model,
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
