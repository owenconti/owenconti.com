---
slug: posts/connecting-to-elasticache-with-laravel-when-using-encryption-in-transit
title: 'Connecting to ElastiCache with Laravel when using Encryption In-Transit'
type: post
category_slug: laravel
excerpt: 'If you''re using ElastiCache with the Encryption In-Transit setting turned on, you''ll need to tweak your REDIS_HOST environment variable when connecting with Laravel'
updated_at: 1590683382
created_at: 1590683382
---

If you're using ElastiCache with the Encryption In-Transit setting turned on, you'll need to tweak your REDIS_HOST environment variable when connecting with Laravel:

```bash
// Before
REDIS_HOST=some-master-node.cache.amazonaws.com

// After
REDIS_HOST=tls://some-master-node.cache.amazonaws.com
```

That will tell your Redis client to use TLS when connecting to your ElastiCache instance.