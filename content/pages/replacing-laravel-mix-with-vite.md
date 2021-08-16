---
slug: posts/replacing-laravel-mix-with-vite
title: 'Replacing Laravel Mix with Vite'
type: post
category_slug: laravel
excerpt: 'In this guide, we''ll replace Laravel Mix with Vite in a Laravel Jetstream (Inertia/Vue) application.'
updated_at: 1628098577
created_at: 2021-02-21
---

In this guide, we'll replace Laravel Mix with Vite in a Laravel Jetstream (Inertia/Vue) application.

[Vite](https://vitejs.dev/) is a build tool created by Evan You (creator of Vue) which utilizes the availability of native ES modules in the browser. Read more about Vite on the [Why Vite page](https://vitejs.dev/guide/why.html).

**NOTE**: This is my first time using Vite. I do not have a full understanding of Vite at the time of writing this post. If you see anything incorrect with this setup, please let me know on Twitter, [@owenconti](https://twitter.com/owenconti).

### TLDR;

If you want to get up and running right away, consider using the [Laravel Vite package](https://laravel-vite.netlify.app/) created by Enzo Innocenzi which is an opinionated setup that handles everything for you.

### TLDR; extended (Vue 3)

> Note: Vite recommends **not** omitting file extensions for custom import types, ie: `.vue` files.
> 
> [https://vitejs.dev/config/#resolve-extensions](https://vitejs.dev/config/#resolve-extensions)
> 
> This means you should ensure all of your imports use the `.vue` extension throughout your codebase.

Install npm dependencies:

```bash
npm install --save-dev vite @vitejs/plugin-vue dotenv @vue/compiler-sfc
```

Uninstall Laravel Mix dependency and remove the config file:

```bash
npm uninstall laravel-mix
rm webpack.mix.js
rm webpack.config.js
```

Setup PostCSS:

```js
// postcss.config.js

module.exports = {
  plugins: [
    require('postcss-import'),
    require('tailwindcss')
  ]
}
```

Create `vite.config.js` file:

```js
import vue from '@vitejs/plugin-vue';
const { resolve } = require('path');
const Dotenv = require('dotenv');

Dotenv.config();

const ASSET_URL = process.env.ASSET_URL || '';

export default {
  plugins: [
    vue(),
  ],

  root: 'resources',
  base: `${ASSET_URL}/dist/`,

  build: {
    outDir: resolve(__dirname, 'public/dist'),
    emptyOutDir: true,
    manifest: true,
    target: 'es2018',
    rollupOptions: {
      input: '/js/app.js'
    }
  },

  server: {
    strictPort: true,
    port: 3000
  },

  resolve: {
    alias: {
      '@': '/js',
    }
  },

  optimizeDeps: {
    include: [
      'vue',
      '@inertiajs/inertia',
      '@inertiajs/inertia-vue3',
      '@inertiajs/progress',
      'axios'
    ]
  }
}
```

Ensure environment variables are set:

```bash
// .env

// Running locally
APP_ENV=local
ASSET_URL=http://localhost:3000

// Running production build
APP_ENV=production
ASSET_URL=https://your-asset-domain.com
```

Install Laravel Vite Manifest PHP package to include Vite's output files from the generated manifest:

```bash
composer require ohseesoftware/laravel-vite-manifest
```

Add the Blade directive from the package which includes the generated assets:

```php
// app.blade.php

<head>
	// ... rest of head contents here
	@vite
</head>
```

Add npm scripts to run Vite:

```json
// package.json

"scripts": {
    "start": "vite",
    "production": "vite build"
},
```

Import your `.css` file inside your entry `.js` file:

```js
// app.js

import '../css/app.css';
```

Make a few minor changes for Inertia:

```js
// Add the polyfill for dynamic imports to the top of your entry .js file

import 'vite/dynamic-import-polyfill';

// Change how dynamic pages are loaded

const pages = import.meta.glob('./Pages/**/*.vue');

// Update the `resolveComponent` logic

resolveComponent: name => {
  const importPage = pages[`./Pages/${name}.vue`];

  if (!importPage) {
    throw new Error(`Unknown page ${name}. Is it located under Pages with a .vue extension?`);
  }

  return importPage().then(module => module.default);
}
```

That's the quick version. If you want to understand more about each step, keep reading.

## Walkthrough

Here's what we're going to setup:

- Replace a default Laravel Mix setup

- Compile JS (Vue)

- Compile CSS (Tailwind)

If your existing Laravel Mix is more complicated than that, your mileage may vary with this guide.

We'll setup both a Vue 2 version and a Vue 3 version.

## Setting up the vite.config.js file

To start off, we need to create a `vite.config.js` file in the root of the repo.

**Vue 2:**

```js
import { createVuePlugin as Vue2Plugin } from 'vite-plugin-vue2';
const { resolve } = require('path');
const Dotenv = require('dotenv');

Dotenv.config();

const ASSET_URL = process.env.ASSET_URL || '';

export default {
  plugins: [
    Vue2Plugin(),
  ],

  root: 'resources',
  base: `${ASSET_URL}/dist/`,

  build: {
    outDir: resolve(__dirname, 'public/dist'),
    emptyOutDir: true,
    manifest: true,
    target: 'es2018',
    rollupOptions: {
      input: '/js/app.js'
    }
  },

  server: {
    strictPort: true,
    port: 3000
  },

  resolve: {
    alias: {
      '@': '/js',
    }
  },

  optimizeDeps: {
    include: [
      'vue',
      'portal-vue',
      '@inertiajs/inertia',
      '@inertiajs/inertia-vue',
      '@inertiajs/progress',
      'axios'
    ]
  }
}
```

**Vue 3:**

```js
import vue from '@vitejs/plugin-vue';
const { resolve } = require('path');
const Dotenv = require('dotenv');

Dotenv.config();

const ASSET_URL = process.env.ASSET_URL || '';

export default {
  plugins: [
    vue(),
  ],

  root: 'resources',
  base: `${ASSET_URL}/dist/`,

  build: {
    outDir: resolve(__dirname, 'public/dist'),
    emptyOutDir: true,
    manifest: true,
    target: 'es2018',
    rollupOptions: {
      input: '/js/app.js'
    }
  },

  server: {
    strictPort: true,
    port: 3000
  },

  resolve: {
    alias: {
      '@': '/js',
    }
  },

  optimizeDeps: {
    include: [
      'vue',
      '@inertiajs/inertia',
      '@inertiajs/inertia-vue3',
      '@inertiajs/progress',
      'axios'
    ]
  }
}
```

Let's run through each section.

### Plugins

The `plugins` section tells Vite how to handle `.vue` files.

```js
// Vue 2
import { createVuePlugin as Vue2Plugin } from 'vite-plugin-vue2';

export default {
  plugins: [
    Vue2Plugin(),
  ]
}

// Vue 3
import vue from '@vitejs/plugin-vue';

export default {
  plugins: [
    vue(),
  ]
}
```

### Root

The `root` option tells Vite what directory is the root directory of our application. Assets will be output relative from this directory. For example, `resources/js/app.js` will be output as `js/app.js`.

```js
// ...

root: 'resources',
```

### Base

The `base` option tells Vite where the assets will be served from once deployed. This is equivalent to the `publicPath` option in Webpack. We pull the `ASSET_URL` from the environment file so that our build uses the correct path when deployed to a CDN.

**Note:** Make sure the `ASSET_URL`is set correctly in your `.env` file when building. If you're deploying with Vapor, Vapor will set the `ASSET_URL` for you.

```js
// ...

base: `${ASSET_URL}/dist/`,
```

### Build

The `build` section tells Vite how the application should be built.

- `outDir` - The output directory that the application should be built to.

- `emptyOutDir` - We set this to true to suppress a warning from Vite that says we are emptying the `outDir` when it exists outside project root (`resources`).

- `manifest` - Tells Vite to publish a manifest file, which we'll use in production builds to find the correct file hash names.

- `target` - Tells Vite which browsers should be supported, you can read more on [Vite's website](https://esbuild.github.io/api/#target).

- `rollupOptions` - These are specific options you can provide to Rollup (which Vite uses to bundle the application). In our case, we need to provide Rollup with our main entry file.

```js
const { resolve } = require('path');

// ...

build: {
  outDir: resolve(__dirname, 'public/dist'),
  emptyOutDir: true,
  manifest: true,
  target: 'es2018',
  rollupOptions: {
    input: '/js/app.js'
  }
}
```

### Server

The `server` section instructs Vite on how to start the development server.

- `strictPort` - Forces Vite to start on the port we specified. Vite will exit if the port is in use as opposed to incrementing the port number which is default behaviour.

- `port` - Which port the Vite development server should run on.

```js
server: {
  strictPort: true,
  port: 3000
},
```

### Resolve

The `resolve` section is optional. In my case, I am using it to alias `@` to `/js`.

```js
resolve: {
  alias: {
    '@': '/js',
  }
},
```

### Optimize Dependencies

We need to tell Vite to pre-bundle the dependencies that do not ship a ESM version. The array you pass here will vary based on the dependencies in your project.

**Note:** `portal-vue` is not necessary in Vue 3 projects.

```js
optimizeDeps: {
  include: [
    'vue',
    'portal-vue', // Vue 2
    '@inertiajs/inertia',
    '@inertiajs/inertia-vue', // Vue 2
    '@inertiajs/inertia-vue3', // Vue 3
    '@inertiajs/progress',
    'axios'
  ]
}
```

### Dependencies to install

You'll need to make sure you install the following JS dependencies:

```bash
// Vue 2
npm install --save-dev vite vite-plugin-vue2 dotenv @vue/compiler-sfc

// Vue 3
npm install --save-dev vite @vitejs/plugin-vue dotenv @vue/compiler-sfc
```

## Setup PostCSS

In order to compile Tailwind, we need to move our PostCSS configuration from `webpack.mix.js` into a dedicated `postcss.config.js` file, which resides at the root of your repo:

```js
// postcss.config.js

module.exports = {
  plugins: [
    require('postcss-import'),
    require('tailwindcss')
  ]
}
```

## Update your Inertia JS setup

Here's my full `app.js` that configures Inertia:

```js
import 'vite/dynamic-import-polyfill';

import { createApp, h } from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';

import axios from 'axios';
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import '../css/app.css';

InertiaProgress.init();

const app = document.getElementById('app');

const pages = import.meta.glob('./Pages/**/*.vue');

createApp({
    render: () =>
        h(InertiaApp, {
            initialPage: JSON.parse(app.dataset.page),
            resolveComponent: name => {
                const importPage = pages[`./Pages/${name}.vue`];
                if (!importPage) {
                    throw new Error(`Unknown page ${name}. Is it located under Pages with a .vue extension?`);
                }
                return importPage().then(module => module.default)
            }
        }),
})
    .mixin({ methods: { route } })
    .use(InertiaPlugin)
    .mount(app);
```

## Environment variables

The asset path is controlled via the standard Laravel `ASSET_URL` environment variable. However, we don't provide a default, so it must be set in order for everything to work.

We need to change a couple of environment variables based on if we're running the local development server vs if we're running a production build:

```bash
// Running locally
APP_ENV=local
ASSET_URL=http://localhost:3000

// Running production build
APP_ENV=production
ASSET_URL=https://your-asset-domain.com
```

## Install the Laravel Vite Manifest package

I wrote a very simple [Laravel package](https://github.com/ohseesoftware/laravel-vite-manifest) to pull the contents of the Vite manifest and include them in your Blade view. The main logic for the package is sourced from [https://github.com/andrefelipe/vite-php-setup](https://github.com/andrefelipe/vite-php-setup).

The package uses the `APP_ENV` and `ASSET_URL` environment variables to decide how to load the assets.

```bash
composer require ohseesoftware/laravel-vite-manifest
```

Add the Blade directive to include Vite's compiled assets:

```php
// app.blade.php

<head>
	// ... rest of head contents here
	@vite
</head>
```

## Remove Laravel Mix

Don't forget to remove Laravel Mix and its configuration file:

```bash
npm uninstall laravel-mix
```