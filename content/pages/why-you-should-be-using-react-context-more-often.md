---
slug: posts/why-you-should-be-using-react-context-more-often
title: 'Why You Should be Using React Context More Often'
type: post
category_slug: react
excerpt: 'React Context can be more than just global state in an app. I like to think of Context as "encapsulated state".'
updated_at: 1610382863
created_at: 1610382863
---

When people think of context in a React JS app, they often think of global state. "I need to manage the theme my app is set to use, I can use context for this." While this isn't wrong, context can be used for so much more than that use case. I like to think of it as "encapsulated state".

Think of context as a component in your tree that can provide props directly to any child below it. Combine that with hooks, and you can write some clean APIs for your components. Let's take a look at a simple example using a Modal component.

Here's a look at a modal that accepts an `onClose` prop which should be called to close the modal. The modal manages its own transition system, so when closing the modal, the modal's custom `closeModal` needs to be called. After the transition is complete, the passed-in `onClose` prop will be called.

```js
// inside your Modal component...

const Modal = ({
	title,
	onClose
}) => {
	const closeModal = useCallback(() => {
		// Fake code, pretend to start the closing transition
		// and call `onClose` when the transition is done
		startCloseTransition(onClose);
	}, [onClose]);

	return (
		<ModalOverlay closeModal={closeModal}>
		  <ModalContent>
		    <ModalHeader title={title} closeModal={closeModal} />
		
		    <ModalBody>
		      {React.cloneElement(children, { closeModal })}
		    </ModalBody>
		  </ModalContent>
		</ModalOverlay>
	);
};
```

Here's the corresponding component that uses the `Modal` component above:

```js
const SomeComponent = () => {
	const [modalOpen, setModalOpen] = useState(false);

	return (
		<div>
			<button type="button" onClick={() => setModalOpen(true)}>Open Modal</button>

			{modalOpen ? (
				<Modal title="Some Modal" onClose={() => setModalOpen(false)}>
					<SomeComponentModalContent />
				</Modal>
			) : null}
		</div>
	);
};

const SomeComponentModalContent = ({
	closeModal
}) => {
	// `closeModal` is available here because the `Modal`
	// component passes it via the `cloneElement` call
	return (
		<div>
			<p>The content of the modal goes here</p>
			<button type="button" onClick={() => closeModal()}>Close the modal</button>
		</div>
	);
};
```

The example above is about as simple as I could make it. However, in a real application the button in `SomeComponentModalContent` may be multiple levels deep, and you'd have to pass `closeModal` down through the tree.

My proposal for an improved API is to introduce a `ModalContext`, which will expose the `closeModal` function. Let's start with the context implementation.

```js
// modal context file...

export const ModalContext = React.createContext();

export const useModal = () => {
	return useContext(ModalContext);
}

export const ModalContextProvider = ({ closeModal, children }) => {
  const context = useMemo(() => {
    return {
      closeModal
    };
  }, [closeModal]);

  return (
    <ModalContext.Provider value={context}>{children}</ModalContext.Provider>
  );
};
```

Note that there's a `useModal` hook in there! That will be important in a moment.

Here's the updated `Modal` component, using the new context:

```js
// inside your Modal component...

const Modal = ({
	onClose
}) => {
	const closeModal = useCallback(() => {
		// Fake code, pretend to start the closing transition
		// and call `onClose` when the transition is done
		startCloseTransition(onClose);
	}, [onClose]);

	return (
		<ModalContextProvider closeModal={closeModal}>
			<ModalOverlay>
			  <ModalContent>
			    <ModalHeader />
			
			    <ModalBody>
			      {children}
			    </ModalBody>
			  </ModalContent>
			</ModalOverlay>
		</ModalContextProvider>
	);
};
```

Notice how `ModalOverlay` and `ModalHeader` no longer accept the `closeModal` prop? Since we've exposed the `closeModal` function via context, you no longer have to pass it as a prop anymore. Instead, `ModalOverlay` would look like this:

```js
// inside ModalOverlay component...

const ModalOverlay = ({
	children
}) => {
	const { closeModal } = useModal();

	return (
		<div onClick={() => closeModal()}>
			{children}
		</div>
	);
};
```

You might argue that the example above is worse off because `closeModal` was a prop before, so we've now added a line by using the hook. You would be right, but let's take a look at an example with nested components, the `ModalHeader` component.

```js
// inside ModalHeader component...

const ModalCloseButton = () => {
	const {closeModal} = useModal();

	return (
		<button type="button" onClick={() => closeModal()}>X</button>
	);
}

const ModalHeader = ({
	title
}) => {
	return (
		<header>
			{title}

			<ModalCloseButton />
		</header>
	);
};
```

By using context here, we can create a generic `ModalCloseButton` component that can be used anywhere within a modal to close the modal. No need to worry about ensuring you have access to the correct props because the `ModalCloseButton` component is responsible for pulling what it needs out of context.

Let's continue by looking at how the parent of the `Modal` component changes.

```js
// No changes to `SomeComponent`...
const SomeComponent = () => {
	const [modalOpen, setModalOpen] = useState(false);
	return (
		<div>
			<button type="button" onClick={() => setModalOpen(true)}>Open Modal</button>

			{modalOpen ? (
				<Modal title="Some Modal" onClose={() => setModalOpen(false)}>
					<SomeComponentModalContent />
				</Modal>
			) : null}
		</div>
	);
};

const SomeComponentModalContent = () => {
	// `SomeComponentModalContent` has access to the modal context
	const {closeModal} = useModal();

	return (
		<div>
			<p>The content of the modal goes here</p>
			<button type="button" onClick={() => closeModal()}>Close the modal</button>
		</div>
	);
};
```

Instead of passing `closeModal` down however many levels of the tree, we leave it to the component needing `closeModal` to grab it out of context.

I've tried to make the examples as simple as possible. In the real world application I pulled this from, the `ModalContext` exposes more than just a `closeModal` function.

We recently built a custom `Stepper` component which allows the user to flow through a series of steps in a form. We used the context/hook pattern to allow custom components in each step to control the flow of the `Stepper` component. The API is so much simpler than prop passing because the custom components only pull what they need out of a hook. Don't need anything? Don't use the hook!
