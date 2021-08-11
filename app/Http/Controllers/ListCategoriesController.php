<?php

namespace App\Http\Controllers;

use App\Models\Category;

class ListCategoriesController extends Controller
{
    public function __invoke()
    {
        $categories = Category::get();

        return view('pages.articles.list', ['categories' => $categories]);
    }
}
