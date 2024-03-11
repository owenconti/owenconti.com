<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexPostsController;
use App\Http\Controllers\ListCategoriesController;
use App\Http\Controllers\ShowCategoryController;
use App\Http\Controllers\ShowOgImageController;
use App\Http\Controllers\ShowSearchResultsController;
use Illuminate\Support\Facades\Route;

Route::feeds();

Route::redirect('/category', '/articles');
Route::redirect('/blog', '/articles');
Route::redirect('/articles', '/posts');
Route::redirect('/articles/{category}', '/posts/{category}');
Route::redirect('/rss', '/feed');

Route::get('/', HomeController::class);
Route::get('/posts', IndexPostsController::class)->name('posts.index');
Route::get('/posts/{category}', ShowCategoryController::class)->name('show.category');
Route::get('/search', ShowSearchResultsController::class);
Route::get('/og-image', ShowOgImageController::class);

Route::get('/{page}', config('pages.routes.handler'))
    ->where('page', '.*')
    ->prefix(config('pages.routes.prefix'))
    ->name(config('pages.routes.name'));
