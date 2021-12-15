---
slug: posts/logging-messages-to-slack-channels-with-laravel
title: 'Logging Messages to Slack Channels with Laravel'
type: post
category_slug: laravel
excerpt: 'Laravel''s logging system makes it very easy to system notifications to your company''s Slack channel.'
updated_at: 1628009241
created_at: 1628009241
---

If you're looking to send Slack notifications to your company's Slack channel when system events happen such as new user created, payment received, etc, then this guide is for you. We'll be using Laravel's built-in logging channels to "log" messages to our Slack channel. The idea is so simple, it took me many years to finally realize how easy it can be.

## Create a Slack webhook URL

You'll need to create a webhook URL using a Slack app. You can follow Slack's [Sending your first Slack message](https://api.slack.com/tutorials/slack-apps-hello-world) guide.

Once you've setup your new Slack app, create a new webhook URL and copy it your clipboard.

## Configuring the Slack channel

We'll need to take the webhook URL that's copied to your clipboard and add it as a new environment variable. I like to call the environment variable `LOGSLACKWEBHOOK_URL`, but you can name it whatever you like:

```bash
// .env

LOG_SLACK_WEBHOOK_URL=https://hooks.slack.com/services/XXXXXX
```

The last configuration step is creating the new log channel. Open up the `logging.php` file. We'll want to copy the exiting `slack` channel and create a new one:

```php
<?php

return [
    'slack' => [
        'driver' => 'slack',
        'url' => env('LOG_SLACK_WEBHOOK_URL'),
        'username' => 'Oh See Snaps',
        'emoji' => ':boom:',
        'level' => 'error'
    ],

    'slackNotification' => [
        'driver' => 'slack',
        'url' => env('LOG_SLACK_WEBHOOK_URL'),
        'username' => 'Oh See Snaps',
        'emoji' => ':wave:',
        'level' => 'info'
    ]
];
```

Note that we changed the `level` from "error" to "info". That will allow any log message with an INFO level or above to be sent to the Slack channel.

## Sending a notification

That's all we have to do for configuration! Now we can start sending system notifications to our Slack channel. Here's an example where I am sending a notification whenever a new user is created:

```php
<?php

Log::channel('slackNotification')->info('New user created', [
    'name' => $user->name,
    'email' => $user->email
]);
```

In Slack, the message comes through like this:

![Slack notification message for a new user](/assets/slack-log-message-example.png)

### Advanced notifications

This guide is for sending simple notifications to your Slack channel. If you need more control or customization options, be sure to check out Laravel's documentation on Slack Notification channels: [https://laravel.com/docs/8.x/notifications#slack-notifications](https://laravel.com/docs/8.x/notifications#slack-notifications)
