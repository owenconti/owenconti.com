<?php

namespace App\Http\Controllers;

use App\Models\Category;

class ShowCategoryController extends Controller
{
    public function __invoke(Category $category)
    {
        return view('pages.articles.show', ['category' => $category]);
    }
}
