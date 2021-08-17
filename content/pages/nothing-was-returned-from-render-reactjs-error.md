---
slug: posts/nothing-was-returned-from-render-reactjs-error
title: '"Nothing was returned from render." ReactJS Error'
type: post
category_slug: react
excerpt: 'Let''s take a look at how you can fix this common error in React.'
video: 4wkG3bq_Frc
updated_at: 1589852174
created_at: 1589852174
---

> Nothing was returned from render. This usually means a return statement is missing. Or, to render nothing, return null.

This warning happens when you're missing a `return` statement in your `render` function, or you attempt to return early, but return `void` via `return;` instead of returning `null`.

```js
function App() {
    if (props.loading) {
        return; // Bad! Should return `null` here instead
    }

    return null; // Fixed!
}
```