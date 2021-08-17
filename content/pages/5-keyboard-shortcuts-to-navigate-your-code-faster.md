---
slug: posts/5-keyboard-shortcuts-to-navigate-your-code-faster
title: '5 Keyboard Shortcuts to Navigate Your Code Faster'
type: post
category_slug: tips
excerpt: 'Here are 5 keyboard shortcuts you can implement in any IDE to help navigate your code faster.'
video: 3M5M8fS9Z3c
updated_at: 1589851985
created_at: 1589851985
---

Here are 5 keyboard shortcuts you can implement in any IDE to help navigate your code faster.

I use VS Code as my IDE, but these shortcuts can be applied to any editor.

The keyboard shortcuts I list in this article are OSX specific, but they should transfer over to Windows if you replace:

* **CMD** with **CTRL**
* **OPTION** with **ALT**
* **CTRL** stays as **CTRL**

_Preface: These shortcuts may not apply to some editors such as Vim, etc._

## Delete line(s)

Before you utilize a delete line shortcut, you find yourself highlighting an entire line and then pressing backspace or delete. This works, however a shortcut can make it much faster. This shortcut also works on multiple lines, if you have multiple highlighted.

* VSCode default: **Shift + CMD + K**
* My keybinding: **CMD + D**

I prefer my keybinding over the VS Code default because I can press it with just my left hand.

## Move line(s)

How often do you find yourself copy/pasting lines to move them up or down throughout a line? With this keyboard shortcut, you can simply use your arrow keys to move lines around.

* VS Code default: **OPTION + up/down arrow key**
* My keybinding: **same as VS Code default**

I stick with the VS Code default for this one because it's what I started out using.

## Go to line

A lot of people don't realize almost all text editors have a Go To Line utility built in. This is really helpful when you are dealing with larger files and need to find a specific line (maybe from the result of a stack trace while debugging).

* VS Code default: **CTRL + G**
* My keybinding: **CMD + L**

I prefer my keybinding because "Line" starts with "L" so it's easier for me to remember **CMD + L** than **CTRL + G**.

## Go back/forward

Let's imagine you have 5 files open and you're trying to follow the code flow between files. Now you want to go back to the previous file and re-read a line, but you can't remember which file it was or what line number.

This shortcut will move your cursor to where it was before/after, even across files. Think of it as an "undo/redo" for your cursor.

**Go back**

* VS Code default: **CTRL + -**
* My keybinding: **CMD + [**

**Go forward**

* VS Code default: **CTRL + SHIFT + -**
* My keybinding: **CMD + ]**

I prefer my keybinding because it is the default in Eclipse, which is where I learned this shortcut. I also prefer the difference of **[** and **]** instead of using **SHIFT** as a modifier.

## Start/end of word

This one is a game changer. How many times do you find yourself holding down left arrow while the cursor slowly moves towards the middle of the line so you can fix a typo or replace a word?

With the start/end of word shortcut (sometimes called **Cursor Word Start/End**), you can quickly navigate one word at a time left/right on a line without holding arrow keys or having to use your mouse.

**_Note:_**_ underscores are considered part of a word while hyphens are not._

* VS Code default: **OPTION + left/right arrow key**
* My keybinding: **same as VS Code default**

## Bonus shortcuts!

I've included two extra shortcuts which are very similar to the **Start/end of word** shortcut.

## Start/end of line

In addition to the start/end of word, you can also quickly go to the start/end of a line by using **CMD** instead of **OPTION:**

* **CMD + left/right arrow key**

## Highlight characters as you use start/end of word/line

Let's say you have some code that looks like this, and your cursor is at the end of the word "world":

```js
const name = "Owen";
console.log(`Hello world!`);
```

Now you want to replace "world" with the `name` variable. You have two options to quickly select "world":

1. Use your mouse and double click "world" 🤮
2. Use the start/end of word shortcut to quickly highlight "world"

Using the shortcut, you would hold **SHIFT + OPTION** and then hit the **LEFT ARROW** key to highlight world. This would highlight just the word "world", which you could then replace with the variable `name`.

## Summary

To summarize what we learned today, here's what I recommend:

* Delete line(s): **CMD + D**
* Move line(s): **OPTION + UP or DOWN ARROW**
* Go to line: **CMD + L**
* Go back/forward: **CMD + [ or ]**
* Start/end of word: **OPTION + LEFT or RIGHT ARROW**
* Highlight characters with start/end of word: **SHIFT + OPTION + LEFT or RIGHT ARROW**

## VS Code keybindings.json file

Here's a copy of my `keybindings.json` file for VS Code if you want to take a look at the rest of my keybindings:

```js
[
  {
    key: "cmd+d",
    command: "editor.action.deleteLines",
    when: "editorTextFocus"
  },
  {
    key: "cmd+t",
    command: "workbench.action.quickOpen"
  },
  {
    key: "cmd+[",
    command: "workbench.action.navigateBack"
  },
  {
    key: "cmd+]",
    command: "workbench.action.navigateForward"
  },
  {
    key: "shift+cmd+b",
    command: "workbench.action.tasks.runTask"
  },
  {
    key: "alt+`",
    command: "workbench.action.terminal.focusPrevious"
  },
  {
    key: "ctrl+cmd+a",
    command: "-extension.align",
    when: "editorTextFocus"
  },
  {
    key: "cmd+\\",
    command: "workbench.files.action.showActiveFileInExplorer"
  },
  {
    key: "cmd+l",
    command: "workbench.action.gotoLine"
  }
];
```