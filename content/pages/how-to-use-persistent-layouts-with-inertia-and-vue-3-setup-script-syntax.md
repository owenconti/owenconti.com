---
slug: posts/how-to-use-persistent-layouts-with-inertia-and-vue-3-setup-script-syntax
title: 'How to use Persistent Layouts with Inertia and Vue 3 Setup Script Syntax'
type: post
category_slug: vue
excerpt: "Here's a quick way you can support persistent layouts with Vue 3's `setup` script syntax."
updated_at: 2022-01-18
created_at: 2022-01-18
---

There's no obvious way to define Inertia's `layout` property on your component when you're using Vue 3's `<script setup>` syntax.

Turns out what you need to do is add a second `<script>` tag to your component, which does _not_ use the `setup` syntax. Instead, you'll export the `layout` key as normal:

```vue
<template>
  // Normal template stuff goes here
</template>

<script>
import CustomLayout from '@/layouts/CustomLayout.vue'

export default {
  layout: CustomLayout
}
</script>

<script setup>
// Normal component JS can go here
</script>
```