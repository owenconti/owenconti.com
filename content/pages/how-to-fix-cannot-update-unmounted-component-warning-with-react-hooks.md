---
slug: posts/how-to-fix-cannot-update-unmounted-component-warning-with-react-hooks
title: 'How to Fix "cannot update unmounted component" Warning with React Hooks'
type: post
category_slug: react
excerpt: 'Learn how to properly unmount React components when using React Hooks.'
video: a7uPQ10UyM0
updated_at: 1589852351
created_at: 1589852351
---

When you attempt to update the state of a component after its been unmounted, React will warn you that you should not do that.

This can happen if you perform an asynchronous side effect (such as loading data) and then unmount the component before the asynchronous function is finished.

When using React's `useEffect` hook, you can keep track of whether the component is mounted and then conditionally update state. This happens within the `useEffect` body:

```js
React.useEffect(() => {
  let unmounted = false;
  setTimeout(() => {
    if (!unmounted) {
      // update state here...
    }
  }, 3000);

  return () => {
    unmounted = true;
  };
});
```

The function we return at the bottom of `useEffect` is called whenever the component is unmounted. This allow us to track a boolean `unmounted` to determine if we should update state when our asynchronous function finishes.

Check out the full example below:

```js
import React from "react";
import ReactDOM from "react-dom";

function App() {
  const [showPage, togglePage] = React.useState(true);

  return (
    <div>
      {showPage ? <Page /> : null}
      <button onClick={() => togglePage(!showPage)}>
        Toggle Page component
      </button>
    </div>
  );
}

function Page() {
  const [data, setData] = React.useState(null);

  React.useEffect(() => {
    let unmounted = false;
    console.log("Running effect to fetch data");

    setTimeout(() => {
      console.log("Data loaded for page");

      if (!unmounted) {
        setData("Some data you loaded from a server somewhere...");
      }
    }, 3000);

    return () => {
      unmounted = true;
    };
  }, []);

  return (
    <div>
      <div>Data: {data}</div>
    </div>
  );
}

const rootElement = document.getElementById("root");
ReactDOM.render(<App />, rootElement);
```