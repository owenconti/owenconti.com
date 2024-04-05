---
slug: posts/using-css-transitions-with-tailwindcss-1-2
title: 'Using CSS Transitions with TailwindCSS v1.2'
type: post
category_slug: tailwindcss
excerpt: 'TailwindCSS 1.2 adds the ability to apply CSS transitions right out of the box!'
updated_at: 1589853320
created_at: 1589853320
---

With the release of TailwindCSS 1.2, you can now create CSS Grids with Tailwind!

Here's a quick example from the Tailwind docs:

```html
<button class="transition-opacity duration-1000 ease-out opacity-50 hover:opacity-100">...</button>
```

When the above button is hovered, the following will happen:

* The opacity will transition from 50% to 100%
* This transition will happen over the duration of 1000ms
* The transition will use an `ease-out` timing function

Check it out!

<div class="p-4 pt-3 mb-4 bg-white border border-gray-300 rounded shadow-inner dark:border-gray-600 dark:bg-gray-900">
    <div class="m-0 mb-4 font-normal tracking-widest text-gray-400 font-heading dark:text-gray-400">Example</div>
    <div><button class="inline-block p-2 text-red-500 transition-opacity duration-1000 ease-out rounded opacity-30 hover:opacity-100">Hover me to see the transition</button></div>
</div>

## What classes are new in 1.2?

`transition-*`

You can use this class to set the transition property. The available options are:

```json
none: 'none',
all: 'all',
default: 'background-color, border-color, color, opacity, transform',
colors: 'background-color, border-color, color',
opacity: 'opacity',
transform: 'transform',
```

So you if you want to transition any of the color properties on your element, use: `transition-colors`.

`duration-*`

Use the duration class to set the transition duration. The available options are:

```json
'75': '75ms',
'100': '100ms',
'150': '150ms',
'200': '200ms',
'300': '300ms',
'500': '500ms',
'700': '700ms',
'1000': '1000ms',
```

`ease-*`

The ease classes allow you to set the timing function for your transition. By default, Tailwind generates a couple custom easing functions for you:

```json
linear: 'linear',
in: 'cubic-bezier(0.4, 0, 1, 1)',
out: 'cubic-bezier(0, 0, 0.2, 1)',
'in-out': 'cubic-bezier(0.4, 0, 0.2, 1)',
```

Be sure to check out the release notes of v1.2 to see all the new features that were released!
