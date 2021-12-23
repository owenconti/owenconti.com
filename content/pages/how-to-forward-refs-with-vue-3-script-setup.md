---
slug: posts/how-to-forward-refs-with-vue-3-script-setup
title: 'How to Forward Refs with Vue 3 and <script setup>'
type: post
category_slug: vue
excerpt: 'Forwarding refs when using <script setup> in Vue 3 is a bit tricky due to some magic happening behind the scenes'
updated_at: 2021-12-22
created_at: 2021-12-22
---

Forwarding refs in Vue 3 using the composition API and `<script setup>` isn't straight forward at first glance. There's two reasons for this:

1. Vue automatically assigns template refs to the component instance the ref was passed to (obvious in hindsight).
2. The component that was assigned the ref needs to explicitly declare which functions/properties it wants accessible via the parent.

## defineExpose

The key to unlocking template ref forwarding is using Vue's `defineExpose` function to explicitly declare which functions/properties of the component should be accessible by the parent.

Here's a broken example that won't work due to no usage of `defineExpose`:

```vue
// Child component
<script setup>
import { ref } from 'vue';

const count = ref(0);
</script>

// Parent component
<template>
  <ChildComponent ref="countComponent" />
</template>

<script setup>
// the `countComponent` ref will be the instance of the `ChildComponent`
const countComponent = ref(null); 

 // This will not work because `ChildComponent` is not exposing `count`
console.log('Current count: ', countComponent.value.count)
</script>
```

The fix here is to have the child component expose `count` via `defineExpose`:

```vue
// Child component
<script setup>
import { ref, defineExpose } from 'vue';

const count = ref(0);
defineExpose({ count });
</script>

// Parent component
<template>
  <ChildComponent ref="countComponent" />
</template>

<script setup>
// the `countComponent` ref will be the instance of the `ChildComponent`
const countComponent = ref(null);

// This will now output 0
console.log('Current count: ', countComponent.value.count);
</script>
```
