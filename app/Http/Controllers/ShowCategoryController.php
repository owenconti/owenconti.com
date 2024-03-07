<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Category;

class ShowCategoryController extends Controller
{
    public function __invoke(Category $category): View
    {
        return view('pages.categories.show', ['category' => $category]);
    }
}
