<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ShowSearchResultsController extends Controller
{
    public function __invoke(Request $request)
    {
        $query = $request->input('query', null);

        if (!$query) {
            return redirect()->route('list.categories');
        }

        $results = Page::posts()
            ->where(function (Builder $builder) use ($query) {
                $builder->where('title', 'like', '%'.$query.'%')
                    ->orWhere('content', 'like', '%'.$query.'%');
            })
            ->get();

        $recentArticles = Page::posts()->orderBy('updated_at', 'desc')->limit(5)->get();

        $title = "Results for: \"{$query}\"";
        seo()->title($title);

        return view('search-results.show', [
            'title' => $title,
            'results' => $results,
            'recentArticles' => $recentArticles,
            'query' => $query,
        ]);
    }
}
