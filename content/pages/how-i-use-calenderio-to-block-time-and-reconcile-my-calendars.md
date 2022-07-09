---
slug: posts/how-i-use-calenderio-to-block-time-and-reconcile-my-calendars
title: 'How I use Calenderio to block time and reconcile my calendars'
type: post
category_slug: tips
excerpt: 'Calenderio saves me time every day by automatically syncing my events and reconciling my calendars for me.'
updated_at: 2022-03-07
created_at: 2022-03-07
---

I have four calendars I manage on a daily basis to organize my time and schedule:

- Full time job
- Consulting job
- Shared family calendar
- Personal calendar

Trying to manage and reconcile four calendars can be a challenge. When I schedule an appointment on my personal calendar, I now need to go block off time on the three other calendars to ensure I don't get double booked. Or when I get invited to a meeting at my full time job, I need to block off that time on my consulting calendar and the family calendar. This takes a lot of time and effort to keep up to date on a regular basis.

![Weekly calendar overview](/assets/weekly-calendar-overview.jpeg)

Rather than manage all of that myself everyday, I now rely on [Calenderio](https://calenderio.com?utm_source=owenconti-com&utm_medium=website&utm_campaign=calenderio-owenconti-com&utm_content=how-i-use-calenderio-article) to keep all of my calendars in sync. At the time of writing this article, I have six connections setup between various calendars in Calenderio. Let's dive into how I have these connections setup.

Figuring out the logistics of how automatic calendar syncing works is very important when understanding how your connections need to be structured. The key thing to remember is that your events will essentially be _duplicated_ across your calendars. So if you have all four calendars added to your local calendar app, you'll see the same event pop up four times. This is the problem I originally ran into until I decided to create a single, "source of truth" calendar.

I've created a dedicated calendar called "Life" which is what I use for my day-to-day calendar interactions. My personal appointments are scheduled directly into the Life calendar, and the three other calendars (Work, Consulting, Family) are all synced to the Life calendar. So now when I view my Life calendar, it contains the events from all four calendars.

Here's a brief diagram on how my connections are setup:

```
Full time job    --> Life
Consulting job   --> Life
Family           --> Life

Life             --> Full time job
Life             --> Consulting job
Life             --> Family
```

You can see above that I have each calendar setup as a two-way sync, meaning events created on the Life calendar are sent to the three other calendars as well. By doing this, it means that an event created on my Work calendar goes through this flow:
1. Event is created by a team member on my Work calendar, ie: I'm invited to a meeting
2. Calenderio syncs the event to my Life calendar
3. Calenderio also syncs the event to my Consulting calendar and Family calendar

Now that event is blocked off on all four calendars that I have to manage. I can rely on my single Life calendar to manage my day-to-day, and my calendar app now looks like this:

![Weekly calendar synced](/assets/weekly-calendar-synced.jpeg)

If you're interested in a walk-through guide of setting up Calenderio for your own calendar syncing, you can check out the ["How to sync your personal calendar to your work calendar"](https://calenderio.com/article/how-to-sync-your-personal-calendar-to-your-work-calendar?utm_source=owenconti-com&utm_medium=website&utm_campaign=calenderio-owenconti-com&utm_content=how-i-use-calenderio-article) guide published on Calenderio's website.
