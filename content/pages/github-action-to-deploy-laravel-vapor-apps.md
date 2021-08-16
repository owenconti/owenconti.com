---
slug: posts/github-action-to-deploy-laravel-vapor-apps
title: 'GitHub Action to Deploy Laravel Vapor Apps'
type: post
category_slug: laravel
excerpt: 'Here''s a GitHub Actions file you can use to deploy Laravel applications to Laravel Vapor.'
updated_at: 1613622198
created_at: 1613622198
---

Here's a quick GitHub Actions file you can use to deploy Laravel Vapor applications.

*   Uses MySQL 8.0
*   Uses PHP 7.4
*   Runs `phpcs` and `phpunit`
*   Deploys `staging` branch to the `staging` Vapor environment
*   Deploys `master` branch to the `production` Vapor environment

Feel free to change any details to suite your application.

The only requirement is you will need to define a `VAPOR_API_TOKEN` secret.

```yaml
name: Build
on: [push, workflow_dispatch]

jobs:
  build-php:
    services:
      mysql:
        image: mysql:8.0
        env:
          MYSQL_USER: root
          MYSQL_ROOT_PASSWORD: root
          MYSQL_DATABASE: laravel
        ports:
          - 3306:3306
        options: --health-cmd="mysqladmin ping" --health-interval=10s --health-timeout=5s --health-retries=3

    name: Build PHP
    runs-on: ubuntu-latest
    container: lorisleiva/laravel-docker:7.4
    steps:
      - uses: actions/checkout@v2
      - run: composer install --prefer-dist --no-ansi --no-interaction --no-progress --no-scripts
      - run: ./vendor/bin/phpcs --standard=./phpcs.xml --extensions=php app --warning-severity=0
      - run: npm ci
      - run: npm run dev
      - name: Configure application
        run: |
          cp .env.ci .env
          php artisan cache:clear
          php artisan config:clear
          php artisan key:generate
      - run: ./vendor/bin/phpunit --colors=never

  deploy:
    if: github.ref == 'refs/heads/master' || github.ref == 'refs/heads/staging'
    name: Deploy application
    runs-on: ubuntu-latest
    container: lorisleiva/laravel-docker:7.4
    needs: [build-php]
    env:
      VAPOR_API_TOKEN: ${{ secrets.VAPOR_API_TOKEN }}
      VAPOR_ENV: ${{ github.ref == 'refs/heads/master' && 'production' || 'staging' }}
    steps:
      - uses: actions/checkout@v2
      - run: composer install --no-dev --prefer-dist --no-ansi --no-interaction --no-progress --no-scripts
      - run: ./vendor/bin/vapor deploy ${{ env.VAPOR_ENV }}
```