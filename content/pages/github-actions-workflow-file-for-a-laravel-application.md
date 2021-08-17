---
slug: posts/github-actions-workflow-file-for-a-laravel-application
title: 'GitHub Actions Workflow File for a Laravel Application'
type: post
category_slug: laravel
excerpt: 'The following workflow script can be used as a starting point for building and testing a Laravel application with GitHub Actions.'
updated_at: 1589852294
created_at: 1589852294
---

The following workflow script can be used as a starting point for building and testing a Laravel application with GitHub Actions:

```yaml
name: Build
on: [push]

jobs:
  build-js:
    name: Build JS
    runs-on: ubuntu-18.04
    container: 'ohseemedia/laravel-ci:7.3'
    steps:
      - uses: actions/checkout@v1
      - run: yarn install
      - run: yarn run production
  build-php:
    name: Build PHP
    runs-on: ubuntu-18.04
    container: 'ohseemedia/laravel-ci:7.3'
    steps:
      - uses: actions/checkout@v1
      - run: composer install --prefer-dist --no-ansi --no-interaction --no-progress --no-scripts
      - name: Configure application
        run: |
          cp .env.example .env
          php artisan cache:clear
          php artisan config:clear
          php artisan key:generate
      - run: ./vendor/bin/phpunit --coverage-text --colors=never
```