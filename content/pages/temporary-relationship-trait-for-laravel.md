---
slug: posts/temporary-relationship-trait-for-laravel
title: 'Temporary Relationship Trait for Laravel'
type: post
category_slug: laravel
excerpt: 'Here''s a small trait you can use to access "temporary" relationships in Laravel.'
updated_at: 1625760441
created_at: 1625760441
---

This trait provides a `temporary($relationship)` method on your model for you to access relationships without adding them to the list of loaded relationships.

If the relationship is already loaded, it is returned directly. If the relationship is not loaded, it will be loaded, removed from the list of loaded relationships, and then returned.

The function is wrapped in Spatie's [once](https://github.com/spatie/once) package to add memoization. This allows the same temporary relationship to be called multiple times without multiple DB queries.

```php
<?php

namespace App\Models\Traits;

trait TemporaryRelationships
{
    /**
     * Returns the value of the given relationship from the current model.
     *
     * If the relation is already loaded, it is returned directly.
     *
     * If the relation is not loaded, it is loaded, then removed
     * from the list of loaded relations, and then returned.
     *
     * The function is memoized so accessing the same temporary
     * relation within a request will only make one query.
     */
    public function temporary(string $relation)
    {
        return once(function () use ($relation) {
            if ($this->relationLoaded($relation)) {
                return $this->{$relation};
            }

            $relationValue = $this->getRelationValue($relation);
            $this->unsetRelation($relation);

            return $relationValue;
        });
    }
}
```

Use it within a model:

```php
<?php

namespace App\Models;

use App\Models\Traits\TemporaryRelations;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use TemporaryRelations;

    public function someMethod()
    {
        return $this->temporary('author');
    }

    public function author()
    {
        return $this->belongsTo(User::class);
    }
}
```