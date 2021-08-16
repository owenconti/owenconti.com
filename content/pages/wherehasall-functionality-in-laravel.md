---
slug: posts/wherehasall-functionality-in-laravel
title: '"Where Has All" Functionality in Laravel'
type: post
category_slug: laravel
excerpt: 'Laravel doesn''t have a `whereHasAll` method built in, but here''s how you can replicate it yourself.'
updated_at: 1623430938
created_at: 1623430938
---

By default, a `whereHas` query checks to see that the given relation has at least one row for the given constraint, ie:

```php
$authorIds = [1, 2];

Post::whereHas('authors', function ($query, $authorIds) {
    $query->whereIn('id', $authorIds);
})->get();
```

The above query will return posts that were authored by authors with ID 1 or 2\. If, however, we want to find the posts that were authored by both authors 1 and 2, we need to change the query to tell Laravel to include posts that return 2 author relation rows when filtered:

```php

$authorIds = [1, 2];

Post::whereHas('authors', function ($query, $authorIds) {
    $query->whereIn('id', $authorIds);
}, '=', count($authorIds))->get();
```

The above query tells Laravel to load the posts that have 2 author relation records when the author relation records are filtered by the given array of IDs.