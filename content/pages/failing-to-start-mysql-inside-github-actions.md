---
slug: posts/failing-to-start-mysql-inside-github-actions
title: 'Failing to start MySQL inside GitHub Actions'
type: post
category_slug: laravel
excerpt: 'If you''ve recently started running into an issue with MySQL on GitHub Actions, you may need to update your MYSQL_USER variable.'
updated_at: 1618245206
created_at: 1618245206
---

I recently started running into this error on GitHub Actions out of the blue:

> Failed to initialize, mysql service is unhealthy

It turns out, the MySQL docker image had been recently updated to no longer support setting the `MYSQL_USER` environment variable to `root`, since there is already a root user created by default.

To get around this issue, all you have to do is choose a different name for your `MYSQL_USER`:

```yaml
services:
  mysql:
    image: mysql:8
    env:
      MYSQL_USER: laravel_user
      MYSQL_PASSWORD: laravel_pass
      MYSQL_ROOT_PASSWORD: root
      MYSQL_DATABASE: laravel_db
    ports:
      - 3306:3306
    options: --health-cmd="mysqladmin ping" --health-interval=10s --health-timeout=5s --health-retries=3
```

For reference, this is how I had it setup prior to the change:

```yaml
services:
  mysql:
    image: mysql:8
    env:
      MYSQL_USER: root
      MYSQL_PASSWORD: root
      MYSQL_ROOT_PASSWORD: root
      MYSQL_DATABASE: laravel_db
    ports:
      - 3306:3306
    options: --health-cmd="mysqladmin ping" --health-interval=10s --health-timeout=5s --health-retries=3
```