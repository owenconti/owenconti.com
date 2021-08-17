---
slug: posts/my-experience-with-netlify-dev-after-a-couple-of-hours-of-using-it
title: 'My Experience with Netlify Dev After a Couple of Hours of Using It'
type: post
category_slug: devops
excerpt: 'Here''s my review of Netlify Dev after a few hours of using it.'
updated_at: 1589852127
created_at: 1589852127
---

[Netlify Dev](https://www.netlify.com/products/dev/) was announced this morning, April 9, 2019.

In short, it allows you to run Netlify's environment (builds, static hosting, functions, redirects, etc) on your local machine. Once running, it also allows you to open a tunnel to the public internet to access your project _(think [ngrok](https://ngrok.com/))_.

For more information on its features, and how it works, I recommend reading the GitHub repository README: [https://github.com/netlify/netlify-dev-plugin](https://github.com/netlify/netlify-dev-plugin).

Netlify Dev attempts to automatically detect which type of frontend project you have and runs the corresponding command to start the dev server for you. You can find a list of projects it can automatically detect here: [https://github.com/netlify/netlify-dev-plugin/tree/master/src/detectors](https://github.com/netlify/netlify-dev-plugin/tree/master/src/detectors).

## Custom commands

If you're running a project not listed at the link above, you can tell Netlify what command to run via the `netlify.toml`configuration file. For example, this blog is built with NextJS, however I run a wrapper around NextJS called [Nextein](https://github.com/elmasse/nextein). Since I have to run Nextein instead of NextJS for my development server, I need to tell Netlify Dev:

```toml
[dev]
  publish = "out"
  port = 3000
  command = "npm start"
```

* The `[dev]` block tells Netlify to use these settings with the `netlify dev` command
* The `publish` value tells Netlify which directory has our `_redirects` file
* The `port` value tells Netlify which port our development server runs on
* The `command` value tells Netlify which command to run to start our development server _(only needed if running a project not yet detected by Netlify)_

## Environment variables

This is where I've run into the most trouble while trying to use Netlify Dev.

In one of my projects I have a couple environment variables that need to differ between my production deployment and my local environment. For example, the callback URL I pass to Twitter during the OAuth authentication flow.

In production, I set these variables via the "Build environment variables" section in the Netlify UI. In development, I use the [dotenv](https://github.com/motdotla/dotenv) package and a `.env` file (which is ignored by Git) to set the environment variables locally.

Before Netlify Dev was released, I was using the [netlify-lambda](https://github.com/netlify/netlify-lambda) package to run my functions locally. With this setup, my environment variables were working perfectly fine.

However, after switching to `netlify dev` and running the `netlify link` command to link my local project to the project in Netlify _(linking the projects allows Netlify to pull the "production" environment variables from Netlify down to your local machine to use with _`netlify dev`), my local `.env` overrides no longer work. It seems Netlify Dev is preventing the `dotenv` package from overriding the `process.env` values.

I [left a comment](https://github.com/netlify/netlify-dev-plugin/issues/60#issuecomment-481497474) on a related issue on their GitHub repository, so hopefully they can get back to me with an answer on that.

## Summary

In summary, I think Netlify Dev is a great product which will simplify the developer experience when a developer takes advantage of Netlify's full product suite. If a developer is just using the static hosting portion of Netlify, I feel Netlify Dev provides little value. But as soon as you start using Netlify's Functions or `_redirects` features, Netlify Dev makes complete sense.

I do hope they sort out the environment variables issue soon, however.