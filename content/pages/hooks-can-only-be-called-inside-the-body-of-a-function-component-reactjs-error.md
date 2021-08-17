---
slug: posts/hooks-can-only-be-called-inside-the-body-of-a-function-component-reactjs-error
title: '"Hooks can only be called inside the body of a function component" ReactJS Error'
type: post
category_slug: react
excerpt: 'Let''s review the rules of React Hooks, and how you can fix the "Hooks can only be called inside the body of a function component." error.'
video: kf8loX8AN-c
updated_at: 1589851704
created_at: 1589851704
---

> "Hooks can only be called inside the body of a function component."

This is a common warning that developers run into when starting out with hooks in React. There are 3 possible reasons for this warning:

* You may have mismatching versions of React and ReactDOM.
* You may have more than one copy of React running in your application such that the version of React imported by ReactDOM is not that same version that you import in your application.
* **Most common:** You're breaking the rules of hooks. You must only call hooks while React is rendering a function component.

### The rules of hooks

You cannot call hooks in class components:

```js
class App extends React.Component {
    componentDidMount() {
        // BAD!
        const [state, setState] = React.useState(null)
    }
}
```

You cannot call hooks inside event handlers:

```js
function App() {
    return (
        {/* BAD! */}
        <button onClick={() => React.useState(null)}>Button you can click</button>
    );
}
```

You cannot call hooks inside `useMemo`, `useReducer`, or `useEffect`:

```js
function App() {
    React.useEffect(() => {
        // BAD!
        const [state, setState] = React.useState(null); 
    });

    return (
        <div>Custom component markup</div>
    );
}
```

You cannot call hooks outside of React altogether:

```js
// BAD!
const [globalState, setGlobalState] = React.useState(null); 

function App() {
    return (
        <div>Custom component markup</div>
    );
}
```

Instead, call hooks at the top level function of your component:

```js
function App() {
    const [state, setState] = React.useState(null); 

    // Use the state in `useEffect`
    React.useEffect(() => {
        axios.get(`/api/${state}`);
    });

    return (
        <div>
            <button onClick={() => {
                // Use the state inside an event handler
                setState(state + 1);
            }}>Click this button</button>
        </div>
    );
}
```
