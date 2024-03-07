<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Schema\Blueprint;
use Orbit\Concerns\Orbital;

class Category extends Model
{
    use Orbital;

    protected $guarded = [];

    public static function schema(Blueprint $table)
    {
        $table->string('slug');
        $table->string('title');
    }

    public function getUrlAttribute()
    {
        return url(route('show.category', $this));
    }

    public function getKeyName()
    {
        return 'slug';
    }

    public function getIncrementing()
    {
        return false;
    }

    public function pages(): HasMany
    {
        return $this->hasMany(Page::class, 'category_slug', 'slug')->orderBy('created_at', 'desc');
    }
}
