<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListCategoriesController;
use App\Http\Controllers\ShowCategoryController;
use App\Http\Controllers\ShowSearchResultsController;
use Illuminate\Support\Facades\Route;

Route::feeds();

Route::redirect('/category', '/articles');
Route::redirect('/blog', '/articles');
Route::redirect('/rss', '/feed');

Route::get('/', HomeController::class);
Route::get('/articles', ListCategoriesController::class)->name('list.categories');
Route::get('/articles/{category}', ShowCategoryController::class)->name('show.category');
Route::get('/search', ShowSearchResultsController::class);

Route::get('/{page}', config('pages.routes.handler'))
    ->where('page', '.*')
    ->prefix(config('pages.routes.prefix'))
    ->name(config('pages.routes.name'));
