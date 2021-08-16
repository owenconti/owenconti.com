---
slug: posts/validating-props-in-vue
title: 'Validating Props in Vue'
type: post
category_slug: vue
excerpt: 'Use Vue''s built-in prop validators to validate your component''s props.'
video: kM7uOwB1Qfc
updated_at: 2021-01-10
created_at: 2021-01-10
---

Here's a quick recap on validating props in Vue. All of these examples use Vue's built-in prop validation.

> **Note:** The prop validation does not get bundled when building in a `production` environment. This means the prop validation acts as a warning during development, but has no impact when shipped to your users.

### Validate one or many types

Validate that the `name` prop must be an (optional) string:

```js
{
  props: {
    name: String
  }
}
```

Validate that the `name` prop must be either an (optional) string or number:

```js
{
  props: {
    name: [String, Number]
  }
}
```

> **Note:** For doing anything other than basic type checking, you need to set the value of your prop to an object. Be aware of the new syntax in the upcoming examples.

### Optional vs required props

By default, props in Vue are optional. When an optional prop is not passed into the component, the prop's value will be `undefined`. If you want to provide a default value for props that are not passed, you can do so via the `default` key. The following example will set the `name` prop to "Hello", if `name` is not passed into the component:

```js
{
  props: {
    name: {
      type: String,
      default: 'Hello'
    }
  }
}
```

When setting the default value to be either an object or an array, you must ensure to wrap the value in a function. By doing this, you will create a new instance of the object or array for each instance of the component:

```js
{
  props: {
    person: {
      type: Object,
      default: () => ({
        name: 'John'
      })
    }
  }
}
```

If you need a prop to be required, you can remove the `default` key and replace it with a `required` boolean value:

```js
{
  props: {
    person: {
      type: Object,
      required: true
    }
  }
}
```

### Custom validation

Sometimes you will need to perform custom validation on a prop. For example, you may have a `status` prop that can only be one of three options: `pending`, `in-progress`, or `complete`. Any other value passed into the `status` prop should be considered invalid.

To run this custom validator, you can use a `validator` function on the props object. The `validator` function takes an argument, which is the value of the prop being validated. For our example, the `value` argument is the value of the `status` prop:

```js
{
  props: {
    person: {
      type: Object,
      required: true,
      validator: value => ['pending', 'in-progress', 'complete'].includes(value)
    }
  }
}
```

## Summary

Make sure you read through Vue's official documentation on prop validation: [https://vuejs.org/v2/guide/components-props.html#Prop-Validation](https://vuejs.org/v2/guide/components-props.html#Prop-Validation)