---
slug: posts/force-php-version-during-github-actions-job
title: 'Force PHP version during GitHub Actions job'
type: post
category_slug: devops
excerpt: 'GitHub has a set of pre-installed packages with the default containers it provides. Learn how you can override the default PHP version.'
updated_at: 1609359769
created_at: 1609359769
---

The packages that come pre-installed on a GitHub Actions job are controlled by the virtual environment you choose to use. Recently, GitHub updated the set of default packages on their virtual environments, including the default PHP version from 7.4 to 8.0\. This caused havoc with some of my GitHub Action builds, which aren't yet ready to use PHP 8.

To use a previous version of PHP with your GitHub Actions build, you can use the [Setup PHP Action](https://github.com/marketplace/actions/setup-php-action):

```yaml
name: Build
jobs:
    test:
        name: Test
        runs-on: ubuntu-18.04
        steps:
            - uses: actions/checkout@master
            - name: Checkout
            - name: Setup PHP with PECL extension
              uses: shivammathur/setup-php@v2
              with:
                php-version: '7.4'
```

The above example will install and setup PHP 7.4 as the default for the rest of the job.

If you are curious to know what packages come pre-installed with GitHub Action's virtual environments, you can check them out on the [actions/virtual-environments repository](https://github.com/actions/virtual-environments#available-environments).