---
slug: posts/faking-the-queue-in-laravel-tests
title: 'Faking the Queue in Laravel Tests'
type: post
category_slug: laravel
excerpt: 'Here''s a quick package you can use to fake the Queue for a specific set of lines in a Laravel test.'
updated_at: 1590068935
created_at: 1590068935
---

I'm working on a project where we use observers to dispatch a chain of jobs whenever a `Volume` model is created. While this is great when working on the code base, it can make it a bit difficult to write tests. For example, I want to test one of the jobs in the chain that is dispatched. Specifically, I want to make sure that the job fails when it should, and with the correct message.

So here's what I need the test to do:

* Fake the `JobFailed` event so we can assert it was dispatched correctly
* Create our model, but while the queue is faked, so the chain of jobs dispatched by the observer will not run
* Dispatch the job we want to test
* Assert the `JobFailed` event was fired

Here's what the test looked like originally:

```php
<?php

/** @test */
public function it_fails_attach_volume_to_instance_if_volume_is_not_in_provisioning_state() {
    Event::fake([JobFailed::class]);

    $queue = Queue::getFacadeRoot();
    Queue::fake();

    $volume = VolumeFactory::make()->pending()->create();

    Queue::swap($queue);

    AttachVolumeToInstance::dispatch($volume);

    Event::assertDispatched(JobFailed::class, function ($event) {
        return $event->exception->getMessage() === 'Volume is not in Provisioning state.';
    });
}
```

I didn't like the idea of having to store the `$queue` facade root and then having to replace it after. So I wrapped that up into a package:

```php
<?php

/** @test */
public function it_fails_attach_volume_to_instance_if_volume_is_not_in_provisioning_state()
{
    // Given
    Event::fake([JobFailed::class]);

    $volume = null;
    QueueFake::wrap(function () use (&$volume) {
        $volume = VolumeFactory::make()->pending()->create();
    });

    // When
    AttachVolumeToInstance::dispatch($volume);
    
    // Then
    Event::assertDispatched(JobFailed::class, function ($event) {
        return $event->exception->getMessage() === 'Volume is not in Provisioning state.';
    });
}
```

Now anytime we need to fake the queue for just a couple of lines, I can use `QueueFake::wrap()`. The queue will be faked for the duration of the closure.

Check it out on GitHub: [https://github.com/ohseesoftware/laravel-queue-fake](https://github.com/ohseesoftware/laravel-queue-fake)