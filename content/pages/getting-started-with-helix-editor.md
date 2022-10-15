---
slug: posts/getting-started-with-helix-editor
title: 'Getting Started With Helix Editor'
type: post
category_slug: thoughts
excerpt: "As a developer who has used an IDE for the past 12 years, here's my first look at using Helix Editor, a terminal-based text editor."
updated_at: 2022-10-15
created_at: 2022-10-15
---
Warning! Before you get started, know that I've never used Vim, Neovim, or
any other text editor. I come from Eclipse (Java), PhpStorm, and most recently
VS Code.

Also know that I'm writing this entire blog post in Helix. Everytime I run into quirk or paper cut, I'll add it to this post.

## Quirks and paper cuts

### Line wrapping

The first quirk I've ran into is the lack of line wrapping. You can use a command to wrap the selected lines, but it would be much preferred if there was a fixed width setting to wrap at.

### Lack of variables in custom commands/keymaps

If variables were accessible in custom commands/keymaps, then you'd be able to add a lot of custom workflows right out of the box.

For example, in VS Code I use an extension called [Better PHPUnit](https://marketplace.visualstudio.com/items?itemName=calebporzio.better-phpunit)
to run my PHP tests via custom key binds. If Helix exposed variables such as the current function name, current filename, etc, then
you could write a keymap to run tests directly from the editor.

## Common commands

Here's a list of common commands that I run, mostly for me to use as a reference guide.

## Custom commands

### Opening lazygit

While transitioning to Helix, I'm also going to try a text-based Git client, [lazygit](https://github.com/jesseduffield/lazygit).

Although there is a rendering issue with Helix after closing lazygit, I have a created a custom keymap to open lazygit:

```
[keys.normal]
l = { g = ":sh lazygit" }
```

### Save and close buffer

This keymap allows you to save and close the buffer with two keypresses:

```
[keys.normal]
l = { w = [":w", ":bc"] }
```

### Close buffer without saving

This keymap will close the buffer without saving:

```
[keys.normal]
l = { q = ":bc!" }
```

## Full Helix config

Here's my full current Helix config file. I'll try to keep it updated!

```
theme = "bogster"

[editor]
line-number = "relative"
mouse = false
auto-format = true

[editor.cursor-shape]
insert = "bar"
normal = "block"
select = "underline"

[editor.file-picker]
hidden = false
ignore = true
git-ignore = false

[keys.normal]
l = { g = ":sh lazygit", q = ":bc!", w = [":w", ":bc"] }
```