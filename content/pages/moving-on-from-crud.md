---
slug: posts/moving-on-from-crud
title: 'Moving on from CRUD'
category_slug: laravel
type: post
draft: true
updated_at: 2021-08-18
created_at: 2021-08-18
---

Before we begin, please review and confirm you agree with the following points. If you don't agree with these points, this article may not be for you.

- DX to find a piece of code is top priority
  - Devs should never have to use global search to find code
  - Devs should never have to use the file explorer to find code
  - Any dev you ask on your team should give you the same answer when asked which file X piece of code is in
  - These points will mean devs will not get frustrated while looking for something in the code base
- Smaller files are easier to read, parse, understand, and edit. There's less to manage in your head when files are smaller.
- Patterns should be defined, documented, and enforced
  - The entire premise of this article only works if the patterns you define for your team are followed. This article will show you a very simple pattern that is hard to get wrong.

## CRUD Review

CRUD stands for Create, Read, Update, Delete. It was coined by [James Martin in 1983](https://en.wikipedia.org/wiki/Create,_read,_update_and_delete). Think back to 1983, what types of applications were being built back then? I would argue that applications we build today look and function nothing like the ones built in 1983. Sure, there's some similarities, but most of the applications being built today are much more advanced than they were back then.

We can expand on CRUD to make naming in our application simple.

## Web Request Review

Let's start by reviewing a typical web request to create a new user:

- The route is matched in our `web.php` routes file
- The controller defined in the route is invoked
- The request class is created and validated
- The controller creates the user
- The controller returns the newly created user via either a view, or a resource, etc

Outside the flow of the request, you ideally have feature tests written for the endpoint as well.

Counting the files involved, specifically for the endpoint, we have:

- The controller
- The request
- The resource or view
- The feature tests

Out of those 4 files, the only one that would normally be reused across endpoints is the resource/view, ie: you may have a `UserResource` returned from an endpoint that cretes a user and returned from an endpoint that lists users.

So we have 3, maybe 4 files, all related to the same request. The traditional approach to structuring these files would be:

- `UserController@store`
- `StoreUserRequest`
- `UserResource` or `users.edit` view
- `UserTests`

There's a pattern there, but it's not very specific:

- Controllers are named by their resource
- Requests are named by `{Action}{Resource}`
- Resources are named by their resource
- Test classes are named by their resource

The devs on your team could manage their way around this. They'd need to use search and scroll techniques to find what they're looking for, but that's fine.

**But life can be better.**

### Hypothetical scenario

Let's run through some hypotheticals using the above example request:

- You now need to implement all 8 CRUD (index, show, create, post, edit, update, destroy, restore) methods for the User resource
  - The controller is now 100s of lines. Good luck finding what you're looking for via a file name. At best, you can open the controller and then scroll or search within the file.
- Every endpoint you write should have at least 3 tests:
  - A happy test for a 200 response
  - A test for invalid data
  - A test for unauthorized users
  - We now have at least 20+ tests covering 8 endpoints written in our `UserTests` class. Again, good luck finding what you're looking for.
- We need to add another endpoint that isn't a typical CRUD method. Let's say this endpoint is used to sync users to an external service.
  - Where does this new logic go?
  - Do we add a new method to the `UserController`? We could, but now our controllers are breaking their CRUD pattern.
  - We could add a `SyncUsersController`. This feels weird because now we have a single controller breaking the CRUD pattern and what would we name the method in the controller?

We can fix all of these problems by using two patterns which allow us to never think about a naming decision again:

- Shared naming convention for files
- Single action controllers

These patterns will solve the points made in the beginning of the article:

- Devs should be able to find code via file name
- Files should be small for readability
- We have a defined and documented pattern for devs to use

## Single Action Controllers

I'm going to start with single action controllers. The premise is simple: you have one controller per endpoint. No exceptions.

Laravel has built-in support for single action controllers, I'll defer to the [Laravel documentation](https://laravel.com/docs/8.x/controllers#single-action-controllers) for you to review. In short, you make a new controller like normal, but instead of worrying about what to name the method, you use PHP's magic `__invoke` method. When registering the route, you pass the controller class without defining a method and Laravel automatically calls the `__invoke` method on the controller for you.

Right away, we've taken away a naming decision for the developer. No more worrying about what to name mehtods in the controller. 

## Naming Convention for Files

In combination with Single Action Controllers, we also define a new naming convention for our files. This includes controllers, requests, tests, and views (both Blade and JavaScript frontend views). They key to this approach is that the naming method you choose remains consistent across all of your files. Do not flip the naming pattern for tests, for example!

The naming pattern I recommend is: `{Verb}{Subject}{Type}`, where:

- `Verb`: action being performed
- `Subject`: resource being modified/accessed
- `Type`: type of file (controller, request, view, test, etc)

It works well for a couple reasons:

- It reads nicely, ie: `StoreUserController`, `DeleteServerRequest`. The opposite way also works, but it doesn't read as nicely to me: `UserStoreController`, `ServerDeleteRequest`. Another argument for the `{Subject}{Verb}{Type}` approacbh is that it makes your file structure more organized, however, I think that argument is lost when you've namespaced your files by the `{Subject}` (which you should being doing!).
- Every endpoint is performing an action on a resource (or collection of resources). In the case of the `{Verb}{Subject}{Type}` naming pattern, the `Verb` is the action, the `Subject` is the resource or collection of resources. This means we always have an action and we always have a resource.
- A simple pattern like this means you no longer have to decide what to name your files. You already know what the action and resource are for your endpoint, so you know the name of the file.

The one remaining wildcard of this approach is that you need to decide on naming patterns for your actions. For example, when you need to return a list of resources, do you call that "indexing" or "listing"? I'll leave those decisions up to you and your team, but my recommendations are to follow the default conventions of:

- Index: list resources
- Show: view a single resource
- Create: display the form to create a new resource
- Store: create the new resource
- Edit: display the form to edit a resource
- Update: update the resource
- Delete: delete a resource
- Restore: restore a resource

If you have other actions your app performs such as "syncing users" or "provisioning servers", you can just use those verbs! (Mind blowing, right??)

- Sync: sync a resource
- Provision: provision a resource
- Duplicate: duplicate a resource

This is the key to this naming pattern. **You*- (or your team) are in control. You decide on your set of actions/verbs that your app has to perform, and you name your files around those actions/verbs.

Let's run this approach through a bunch of different endpoints:

- Creating a new user
  - `CreateUserController`: shows the form to create a new user
  - `CreateUserTest`: tests that assert the form is displayed correctly
- Storing a new user
  - `StoreUserController`: stores the new user data in the database
  - `StoreUserRequest`: request class to validate the user sent when storing a new user
  - `StoreUserTest`: tests to ensure a new user can be saved, validation is correct, authorization/permissions are correct
- Syncing posts to a 3rd party
  - `SyncPostsController`: syncs the posts to the 3rd party
  - `SyncPostsRequest`: validates the input to sync the posts is correct
  - `SyncPostsTest`: tests to ensure the posts sync correctly, the input data is validated, authorization/permissions are correct

Starting to see the pattern? What about the _ease_ of the naming? The names make sense, don't they? Because they're named the **exact*- thing they do.

## Conclusion

TLDR; Use single action controllers and name your files via a naming pattern of: `{Verb}{Subject}{Type}`, which corresponds to the single responsibility of the file.

After reading this article, I hope you're ready to re-consider how you structure/name your Laravel (or other web framework) files. It took me months of a friend trying to convince me on this pattern, but once I adopted it, I've never looked back.


