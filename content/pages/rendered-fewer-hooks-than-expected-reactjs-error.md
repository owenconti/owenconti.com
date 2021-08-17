---
slug: posts/rendered-fewer-hooks-than-expected-reactjs-error
title: '"Rendered fewer hooks than expected." ReactJS error'
type: post
category_slug: react
excerpt: 'Learn how to fix the "Rendered fewer hooks than expected." error with React Hooks.'
video: Zx13z4Is_PA
updated_at: 1589851796
created_at: 1589851796
---

In React, hooks must be called during render, and they must be called unconditionally and in the same order every render.

This means if you have a conditional `if` statement in your render logic, hooks cannot be within the conditional branch.

```js
function MyComponent(props) {
    if (props.id) {
        // BAD! Hooks cannot be used inside a conditional statement
        useEffect(() => {
            axios.get(`/api/data?id=${props.id}`);
        });
    }

    // ...render the component
}
```

It also means that you cannot use hooks after your conditional statement, if your conditional statement returns early, ie:

```js
function MyComponent(props) {
    if (props.loading) {
        return <Loading />;
    }

    const [state, setState] = useState(null)

    return (
        <div>My component markup here...</div>
    );
}
```

In this case, if the `loading` prop is true, our component will return early resulting in the hook sometimes being called instead of always being called.

Okay, so what if I **need** to conditionally call a hook?

You can move the conditional logic inside of the hook:

```js
function MyComponent(props) {
    useEffect(() => {
        if (props.id) {
            axios.get(`/api/data?id=${props.id}`);
        }
    }, [props.id]);

    // ...render the component
}
```

The key is to make sure that all hooks you use are called every render, because React is tracking the hook calls (and their order!) behind the scenes.