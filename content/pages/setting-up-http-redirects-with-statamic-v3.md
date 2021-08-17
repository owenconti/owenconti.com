---
slug: posts/setting-up-http-redirects-with-statamic-v3
title: 'Setting Up Dynamic HTTP Redirects with Statamic v3'
type: post
category_slug: statamic
excerpt: 'You can use Statamic''s redirect tag plus a custom blueprint to setup dynamic HTTP redirects on your Statamic website.'
updated_at: 1589857968
created_at: 1589857968
---

You can use Statamic's redirect tag plus a custom blueprint to setup dynamic HTTP redirects on your Statamic website.

Let's say you're building a CMS for a client, and they need the ability to create redirects on the fly, eg:

```php
'/some-old-slug' => '/new-slug'
```

We can do this using Statamic's `redirect` tag. The premise is essentially:

* Create a blueprint that has a single field which we'll input our destination URL into
* We create a new layout file that only has a `redirect` tag in it
* Create a collection to store the redirects for the site
* The slug of each redirect entry will be the "from" URL

## Create the blueprint

First, we need to create the blueprint. Here's what I am using:

```yaml
title: Redirect
sections:
  main:
    display: Main
    fields:
      -
        handle: redirect_location
        field:
          characterlimit: 0
          type: text
          localizable: false
          display: 'Redirect URL'
          validate: required
```

## Create the layout file

Next, we need to create a new layout file. The location of this file depends on your site setup, but for me, the file goes in `resources/views/redirect.antlers.html`:

```html
{{ redirect to="{{ redirect_location }}" }}
```

## Create the collection

Finally, we need to create the collection for the redirect entries. Feel free to use the Control Panel to do this. I'll post my collection's YAML file for reference:

```yaml
title: Redirects
route: '{slug}'
layout: redirect
blueprints:
  - redirect
revisions: false
sort_dir: desc
```

## Add your redirects!

That's it! Now you can create as many redirects as your heart desires! Here's a file showing how I redirect `/rss` to `/feed`:

```yaml
---
title: RSS
entry: 65ede336-9f41-4b20-bae3-cd3cd9435d24
updatedby: 197c1509-8dff-4d72-9898-334084519619
updatedat: 1578797584
redirect_location: /feed
id: f358bf66-3972-4800-864f-aa42eeb7aee4
---
```

Test it out: [/rss](/rss) should take you to [/feed](/feed)