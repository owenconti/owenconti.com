---
slug: posts/building-css-grids-in-tailwindcss-v1-2
title: 'Building CSS Grids in TailwindCSS v1.2'
type: post
category_slug: tailwindcss
excerpt: 'Support for CSS grids has been added to Tailwind v1.2..'
updated_at: 1589853602
created_at: 1589853602
---

Support for CSS grids has been added to Tailwind v1.2\. Here's a little example:

<div class="p-4 pt-3 mb-4 bg-white border border-gray-300 rounded shadow-inner dark:border-gray-600 dark:bg-gray-200">
  <div class="m-0 mb-4 font-normal tracking-widest text-gray-400 font-heading dark:text-gray-500">
    Example
  </div>

  <div>
    <div class="grid w-full grid-cols-2 gap-6 lg:grid-cols-4">
      <div class="col-span-1 bg-red">
        Row 1, Column 1
      </div>
      <div class="col-span-2 bg-blue-500">
        Row 1, Column 2, Span 2
      </div>
      <div class="col-start-1 col-end-2 bg-green-500 lg:col-start-2 lg:col-end-4">
        Row 2, Start 2, End 4
      </div>
      <div class="col-start-1 col-end-2 bg-blue-500 lg:col-end-4">
        Row 3, Start 1, End 4
      </div>
      <div class="col-start-2 col-end-2 lg:col-end-5 bg-red">
        Row 4, Start 2, End 5
      </div>
    </div>
  </div>
</div>

```html
<div class="grid w-full grid-cols-2 gap-6 lg:grid-cols-4">
  <div class="col-span-1 bg-red-500">Row 1, Column 1</div>
  <div class="col-span-2 bg-blue-500">Row 1, Column 2, Span 2</div>
  <div class="col-start-1 col-end-2 bg-green-500 lg:col-start-2 lg:col-end-4">Row 2, Start 2, End 4</div>
  <div class="col-start-1 col-end-2 bg-blue-500 lg:col-end-4">Row 3, Start 1, End 4</div>
  <div class="col-start-2 col-end-2 bg-red-500 lg:col-end-5">Row 4, Start 2, End 5</div>
</div>
```

Tailwind provides support for a lot of CSS grid properties out of the box, but a lot of them don't have default values. The default values are based around a 12-column grid.

`gap-*`

Default values for gap are the spacing values setup in your configuration (same as margin, padding, etc).

```js
theme('spacing')
```

`row-gap-*`

There are no default values for the row-gap classes.

`col-gap-*`

There are no default values for the column gap classes.

`grid-cols-*`

The `grid-cols-*` sets the `grid-template-columns` and is used on the grid wrapper to tell the grid how many columns it should support. Default values:

```json
none: 'none',
'1': 'repeat(1, minmax(0, 1fr))',
'2': 'repeat(2, minmax(0, 1fr))',
'3': 'repeat(3, minmax(0, 1fr))',
'4': 'repeat(4, minmax(0, 1fr))',
'5': 'repeat(5, minmax(0, 1fr))',
'6': 'repeat(6, minmax(0, 1fr))',
'7': 'repeat(7, minmax(0, 1fr))',
'8': 'repeat(8, minmax(0, 1fr))',
'9': 'repeat(9, minmax(0, 1fr))',
'10': 'repeat(10, minmax(0, 1fr))',
'11': 'repeat(11, minmax(0, 1fr))',
'12': 'repeat(12, minmax(0, 1fr))',
```

`col-*`

The `col-*` class sets the `grid-column` property, and tells the element how many columns it should span across. Default values:

```json
auto: 'auto',
'span-1': 'span 1 / span 1',
'span-2': 'span 2 / span 2',
'span-3': 'span 3 / span 3',
'span-4': 'span 4 / span 4',
'span-5': 'span 5 / span 5',
'span-6': 'span 6 / span 6',
'span-7': 'span 7 / span 7',
'span-8': 'span 8 / span 8',
'span-9': 'span 9 / span 9',
'span-10': 'span 10 / span 10',
'span-11': 'span 11 / span 11',
'span-12': 'span 12 / span 12',
```

`col-start-* / col-end-*`

The `col-start-*` and `col-end-*` sets the `grid-column-start` and `grid-column-end` properties on the element. These tell the element where which column to start and end at, respectively. Default values:

```json
'1': '1',
'2': '2',
'3': '3',
'4': '4',
'5': '5',
'6': '6',
'7': '7',
'8': '8',
'9': '9',
'10': '10',
'11': '11',
'12': '12',
'13': '13',
```

---

`grid-rows-*`

The `grid-rows-*` sets the `grid-template-rows` on the element, and is used on the grid wrapper to tell the element how many rows are in the grid. There are no default values.

`row-*`

The `row-*` sets the `grid-row` property on the element, telling it which rows to occupy. There are no default values.

`row-start-* / row-end-*`

The `row-start-*` and `row-end-*` sets the `grid-row-start` and `grid-row-end` properties on the element. These tell the element where which row to start and end at, respectively. There are no default values.

Be sure to read the full [TailwindCSS documentation](https://tailwindcss.com/)!
