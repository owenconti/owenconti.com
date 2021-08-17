---
slug: posts/react-error-boundaries
title: 'React Error Boundaries'
type: post
category_slug: react
excerpt: 'React error boundaries allow you to prevent your React application from completely crashing in the event of an error in your code.'
updated_at: 1589852563
created_at: 1589852563
---

React error boundaries allow you to prevent your React application from completely crashing in the event of an error in your code. 

You can read more about React's error boundaries on their [documentation page](https://reactjs.org/docs/error-boundaries.html).

The key point to understand when using error boundaries is this snippet from the docs:

> catch JavaScript errors anywhere in their child component tree

Specifically, "component tree". If you try to use Error Boundaries in the following way, none of your errors will be caught:

```js
function SomeComponent() {
   return (
    	<CustomErrorCatcher>
        	{invalidVariable}
        </CustomerErrorCatcher>
    );
}
```

In the example above, `CustomErrorCatcher` is our class component that implements our error boundary logic.

The code that is throwing an error, `{invalidVariable}`, is rendering inside the `CustomErrorCatcher` component, instead of in a child component. This is what prevents the error boundary from catching the error. The error boundary _will only_catch errors in child **components**.

So instead, I recommend you do something like this at the top-level of your application:

```js
function Root() {
    return (
    	<CustomErrorCatcher>
        	<App />
        </CustomErrorCatcher>
    );
}
ReactDom.render(<Root />, document.getElementById('app'));
```

This way your entire application is wrapped in an error boundary, in the event that any of your components throw an error.