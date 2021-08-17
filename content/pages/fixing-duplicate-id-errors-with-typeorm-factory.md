---
slug: posts/fixing-duplicate-id-errors-with-typeorm-factory
title: 'Fixing Duplicate ID Errors with typeorm-factory'
type: post
category_slug: typescript
excerpt: 'You need to pay close attention when creating factories with typeorm-factory.'
updated_at: 1600836033
created_at: 1600836033
---

When creating a factory with typeorm-factory, you have to make sure any dynamic data is handled within a closure, otherwise it'll only run once when the factory is imported.

```ts
const PerkCategoryFactory = new Factory(PerkCategory)
  .attr('name', faker.lorem.word());
```

If you define a factory like the above, the `faker.lorem.word()` will only run once, when the factory is imported. This means if you were expecting a random word for each instance the factory creates, you won't get it. Instead, each factory will have the exact same word.

To fix this, you must use a `sequence` instead of `attr`:

```ts
const PerkCategoryFactory = new Factory(PerkCategory)
  .sequence('name', () => faker.lorem.word());
```

The `sequence` will accept a closure as the second argument, which will be invoked whenever the factory creates a new instance.