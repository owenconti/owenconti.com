<?php

namespace App\Http\Controllers;

use ArchTech\Pages\Page;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ShowSearchResultsController extends Controller
{
    public function __invoke(Request $request)
    {
        $query = $request->input('query', null);

        $articles = Page::where('type', 'post')
            ->where(function (Builder $builder) use ($query) {
                $builder->where('title', 'like', '%'.$query.'%')
                    ->orWhere('content', 'like', '%'.$query.'%');
            })
            ->get();

        return view('search-results.show', [
            'articles' => $articles,
            'query' => $query,
        ]);
    }
}
