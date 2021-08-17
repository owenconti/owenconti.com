---
slug: posts/how-to-handle-multiple-events-with-a-single-listener-in-laravel
title: 'How to Handle Multiple Events with a Single Listener in Laravel'
type: post
category_slug: laravel
excerpt: 'Laravel provides a simple way to declare event listeners out of the box via the EventServiceProvider class.'
updated_at: 1589851920
created_at: 1589851920
---

Laravel provides a simple way to declare event listeners out of the box via the `EventServiceProvider` class.

Here's a quick example:

```php
<?php

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        LoginEvent::class => [
            HandleLoginListener::class
        ],
    ];
}
```

With the above, anytime the `LoginEvent` is fired, the `handle()` method of the `HandleLoginListener` class will be called. Pretty simple, right?

But what if you have dozens or even hundreds of events that you want to all go through the same handler?

One option would be to list them out individually in the `EventServiceProvider` class.

Yikes! What if you forget to add the listener when you add a new event?

Another option would be to listen to an [interface](https://www.php.net/manual/en/language.oop5.interfaces.php), and have your events implement the interface.

Here's an example interface:

```php
// App\Events\NotifiableEvent.php

<?php

namespace App\Events;

interface NotifiableEvent
{
    /**
     * Returns the display name of the event.
     *
     * @return string
     */
    public function getEventName(): string;

    /**
     * Returns the description of the event.
     *
     * @return string
     */
    public function getEventDescription(): string;
}
```

And here's an example event, that implements the interface:

```php
// App\Events\CreatedApplicationMember.php

<?php

namespace App\Events;

class CreatedApplicationMember implements NotifiableEvent
{
    public function getEventName(): string
    {
        return 'Created Application Member';
    }

    public function getEventDescription(): string
    {
        return 'Fired whenever a new Application Member is added to your Application.';
    }

    // constructor and stuff goes here...
```

Then in `EventServiceProvider`, you can listen for the interface instead of the specific event classes:

```php
<?php

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        NotifiableEvent::class => [
            SendEventNotification::class
        ],
    ];
}
```

Now anytime an event that implements the `NotifiableEvent` interface is dispatched, the `SendEventNotification` listener will be called.