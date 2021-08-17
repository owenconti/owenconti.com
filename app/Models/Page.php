<?php

namespace App\Models;

use ArchTech\Pages\Page as BasePage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Schema\Blueprint;
use Spatie\Feed\FeedItem;
use Spatie\Feed\Feedable;

class Page extends BasePage implements Feedable
{
    public function toFeedItem(): FeedItem
    {
        return FeedItem::create()
            ->id($this->slug)
            ->title($this->title)
            ->summary($this->excerpt)
            ->updated($this->updated_at)
            ->link($this->url)
            ->authorName('Owen Conti');
    }

    public static function getAllFeedItems()
    {
        return Page::posts()->get();
    }

    public static function schema(Blueprint $table)
    {
        $table->string('slug');
        $table->string('title');
        $table->longText('content');
        $table->text('excerpt')->nullable();
        $table->string('type');
        $table->string('video')->nullable();
        $table->string('category_slug')->nullable();
    }

    public function getUrlAttribute()
    {
        return url($this->slug);
    }

    public function scopePosts(Builder $query)
    {
        $query->where('type', 'post');
    }

    public function scopeInCategory(Builder $query, $category)
    {
        $query->where('category_slug', $category);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_slug');
    }
}
