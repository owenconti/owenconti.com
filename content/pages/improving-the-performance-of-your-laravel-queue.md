---
slug: posts/improving-the-performance-of-your-laravel-queue
title: 'Improving the Performance of your Laravel Queue'
type: post
category_slug: laravel
excerpt: 'Learn how to fix a potential performance problem when serializing models for Laravel jobs.'
updated_at: 1589851428
created_at: 1589851428
---

Out of the box, Laravel has a great API for dispatching jobs:

```php
<?php

ProcessPodcast::dispatch($podcast);
```

That will dispatch the `ProcessPodcast` job, with the `$podcast` being passed in for the job to use as it wants.

Under the hood, Laravel is doing the following:

* Detects an Eloquent Model was passed into the job
* If the job uses the `SerializesModels` trait, the identifier of the passed Model is serialized as the payload of the job
* When the queue processes the job, Laravel unserializes the ID, loads the Model from the database, and passes it to the job

This all works very well and makes using Laravel's Queue system a breeze!

🚨🚨 There's a catch! 🚨🚨

Laravel is trying to be extra helpful by also serializing the loaded relations, and then eagerly loads them when the job is processed.

So let's say in order to dispatch the `ProcessPodcast` job, you have to load 5 relations on the `Podcast` model. When the `ProcessPodcast` job is processed from the queue, all 5 of those relations (and any of their loaded nested relations) are eagerly loaded.

Depending on your application and the logic of your job, this may make a _significant_ impact on your queue's processing time.

### What's the fix?

If your job needs to use the relations to dispatch the job, but does not need those relations when processing the job, you can instead pass the identifier of the model instead of the model itself. It's a little bit more work on your end, because you'll be responsible for pulling the model out of the database on your own, but it also gives you more control.

Now when dispatching your job, you can do this:

```php
<?php

ProcessPodcast::dispatch($podcast->id);
```

And inside your job's class:

```php
<?php

public function __construct(int $podcastId)
{
    $this->podcastId = $podcastId;
}

public function handle()
{
    $podcast = Podcast::findOrFail($this->podcastId);
}
```

In the application I found this issue on, the processing time of one of our jobs went from ~8 seconds down to ~1 second.