---
slug: posts/add-cloudflare-durable-objects-to-environment
title: 'How to add Cloudflare Durable Objects to an environment'
type: post
category_slug: cloudflare
excerpt: "By default, Cloudflare's Durable Objects are not inherited across environments, here's how you can fix it."
updated_at: 2021-10-16
created_at: 2021-10-16
---

For some reason, Cloudflare doesn't automatically inherit Durable Objects to environments like it does for the rest of the Worker settings. To get around this, you must define the Durable Objects for each environment. Here's an example using the default [Counter example Worker](https://github.com/cloudflare/durable-objects-typescript-rollup-esm):

```toml
# Default environment
[durable_objects]
bindings = [{name = "COUNTER", class_name = "CounterTs"}]

[env.staging]
name = "durable-objects-test-staging"

# Need to redefine the binding for the `staging` environment [tl! highlight:2]
[env.staging.durable_objects]
bindings = [{name = "COUNTER", class_name = "CounterTs"}]
```