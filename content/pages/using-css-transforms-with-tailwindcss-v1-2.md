---
slug: posts/using-css-transforms-with-tailwindcss-v1-2
title: 'Using CSS Transforms with TailwindCSS v1.2'
type: post
category_slug: tailwindcss
excerpt: 'You can now use CSS transforms right out of the box with TailwindCSS v1.2.'
updated_at: 1589853772
created_at: 1589853772
---

You can now use CSS transforms right out of the box with TailwindCSS v1.2.

```html
<div class="origin-center transform scale-50 rotate-45 translate-x-full"></div>
```

With the above example, the `div` will be scaled 150%, rotated 45 degrees, translated to the right 100% of the width, and all transformations will be based around the center of the element.

Check these out, all default Tailwind utilities!

<div class="p-4 pt-3 mb-4 bg-white border border-zinc-300 rounded shadow-inner dark:border-zinc-600 dark:bg-zinc-900">
  <div class="m-0 mb-4 font-normal tracking-widest text-zinc-400 font-heading dark:text-zinc-500">
    Example
  </div>
  
  <div>
    <div class="transform scale-50">Scaled down</div>
    <div>
      <div class="inline-block transform rotate-45">Rotated</div>
    </div>
    <div class="w-1/2 transform translate-x-1/2">Translated</div>
  </div>
</div>

```html
<div class="transform scale-50">Scaled down</div>
<div>
  <div class="inline-block transform rotate-45">Rotated</div>
</div>
<div class="transform translate-x-1/2">Translated</div>
```

You can even combine these with CSS transitions ([read more about that here](/posts/using-css-transitions-with-tailwindcss-1-2)):

<div class="p-4 pt-3 mb-4 bg-white border border-zinc-300 rounded shadow-inner dark:border-zinc-600 dark:bg-zinc-900">
  <div class="m-0 mb-4 font-normal tracking-widest text-zinc-400 font-heading dark:text-zinc-500">
    Example
  </div>
  <div>
    <div class="inline-block py-12">
      <div class="inline-block p-2 text-white transition-transform duration-1000 ease-out transform rotate-45 bg-red hover:-rotate-45">
        Hover me to rotate!
      </div>
    </div>
    <div class="inline-block ml-8 transition-transform duration-1000 ease-out transform hover:translate-x-1/2">
      Hover me to slide!
    </div>
  </div>
</div>

```html
<div class="inline-block py-12">
  <div class="inline-block p-2 text-white transition-transform duration-1000 ease-out transform rotate-45 bg-red-500 hover:-rotate-45">Hover me to rotate!</div>
</div>
<div class="inline-block ml-8 transition-transform duration-1000 ease-out transform hover:translate-x-1/2">Hover me to slide!</div>
```

Alright, so let's get into what properties are available by default with Tailwind.

`origin-*`

You can use this property to set the origin of the transformation.

```json
{
  center: 'center',
  top: 'top',
  'top-right': 'top right',
  right: 'right',
  'bottom-right': 'bottom right',
  bottom: 'bottom',
  'bottom-left': 'bottom left',
  left: 'left',
  'top-left': 'top left',
}
```

---

`scale-*`, `scale-x-*`, `scale-y-*`

As expected, these will scale your element either horizontally, vertically, or both. Default scale values:

```json
'0': '0',
'50': '.5',
'75': '.75',
'90': '.9',
'95': '.95',
'100': '1',
'105': '1.05',
'110': '1.1',
'125': '1.25',
'150': '1.5',
```

---

`rotate-*`

This will apply the rotate transformation. Default rotate values are:

```json
'-180': '-180deg',
'-90': '-90deg',
'-45': '-45deg',
'0': '0',
'45': '45deg',
'90': '90deg',
'180': '180deg',
```

Note, that to apply the negative values, you need to prefix the "rotate" with a hyphen, just like negative margin, etc:

`-rotate-45`

---

`translate-*`, `translate-x-*`, `translate-y-*`

This will apply translate transformations to your element. Here are the default values:

```json
{
  ...theme('spacing'),
  ...negative(theme('spacing')),
  '-full': '-100%',
  '-1/2': '-50%',
  '1/2': '50%',
  full: '100%',
}
```

The default values pull in all the spacing configuration values (used for margin, padding, etc).

---

`skew-x-*`, `skew-y-*`

This will apply a skew transformation on your element. Note that there are no default skew values provided.
