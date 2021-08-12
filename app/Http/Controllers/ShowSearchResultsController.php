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

        $articles = Page::posts()
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
