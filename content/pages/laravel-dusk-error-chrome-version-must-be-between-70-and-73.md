---
slug: posts/laravel-dusk-error-chrome-version-must-be-between-70-and-73
title: 'Laravel Dusk Error: "Chrome version must be between 70 and 73"'
type: post
category_slug: laravel
excerpt: 'When using Laravel Dusk, you have to ensure you''re using the correct Chrome Driver version based on the version of Chrome installed on the machine.'
updated_at: 1589852449
created_at: 1589852449
---

When using Laravel Dusk, you have to ensure you're using the correct Chrome Driver version based on the version of Chrome installed on the machine.

For example, if Chrome updates to v79, the next time you run your Dusk tests, you'll run into an error similar to this:

> Facebook\WebDriver\Exception\SessionNotCreatedException: session not created: Chrome version must be between 70 and 73

Generally, the fix for this is to install the correct driver version:

```bash
php artisan dusk:chrome-driver
```

That should be enough to install the correct version of the Chrome Driver based on the version of Chrome you have installed.

However, if the Chrome Driver can sometimes become left running in the background. At the time of writing, I'm not sure _why_ it stays running sometimes. If it does stay running, Dusk will use the already running Chrome Driver instance when running your tests. This means you may be running an old version of Chrome Driver even though you've installed the latest driver.

To fix this, open Activity Monitor and search for "chromedriver". Delete any running Chrome Driver process and then try running your tests again!