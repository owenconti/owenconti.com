<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use ArchTech\Pages\Page as BasePage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Schema\Blueprint;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;

class Page extends BasePage implements Feedable
{
    protected static function booted()
    {
        static::addGlobalScope('published', function (Builder $builder) {
            $builder->whereNull('draft');
        });
    }

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
        $table->boolean('draft')->nullable()->default(false);
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

    public function isPost(): bool
    {
        return $this->type === 'post';
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_slug');
    }
}
