---
slug: posts/create-a-reverse-proxy-with-cloudflare-workers
title: 'Create a Reverse Proxy with Cloudflare Workers'
type: post
category_slug: devops
excerpt: 'Here''s a quick copy/paste snippet you can use to create a reverse proxy server in Cloudflare.'
updated_at: 1625977161
created_at: 1625977161
---

This is my first pass at a reverse proxy script using Cloudflare Workers. It's pretty simple.

```js
addEventListener("fetch", (event) => {
  event.respondWith(
    handleRequest(event.request).catch(
      (err) => new Response(err.stack, { status: 500 })
    )
  );
});

async function handleRequest(request) {
  const { search } = new URL(request.url);

  const params = new URLSearchParams(search);
  params.set('token', OHSEESNAPS_TOKEN);

  return fetch(`https://ohseesnaps.com/api/snap?${params.toString()}`)
}
```

This worker does the following:

1.  Takes the query parameters from the request

2.  Adds a `token` parameter pulled from an environment variable, `OHSEESNAPS_TOKEN`

3.  Sends a request to the proxied server, `https://ohseesnaps.com/api/snap`

4.  When sending the request to the proxied server, the original query parameters (including the added `token` parameter) are sent as well

5.  The response from the proxied server is sent back to the client