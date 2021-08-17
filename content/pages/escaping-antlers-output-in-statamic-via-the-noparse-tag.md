---
slug: posts/escaping-antlers-output-in-statamic-via-the-noparse-tag
title: 'Escaping Antlers Output in Statamic via the `noparse` Tag'
type: post
category_slug: statamic
excerpt: 'By default, when you output content from a field into a template, Statamic will attempt to run that content through the Antlers templating language.'
updated_at: 1589852807
created_at: 1589852807
---

By default, when you output content from a field into a template, Statamic will attempt to run that content through the Antlers templating language. Let's take a look at an example.

Here we have a `redirect` tag written in the content in Bard field:

```yaml
  -
    type: code_block
    content:
      -
        type: text
        text: '{{ redirect to="{{ redirect_url }}" }}'
```

Which looks like this in the editor:

```yaml
{{ redirect to="{{ redirect_url }}" }}
```

Now, if your template outputs the field directly, Statamic will attempt to run that code as if it was a part of the template, in other words, it will attempt to redirect the page.

Example default template code:

```html
<div class="content">
  {{ content }}
</div>
```

There's an easy way to fix this so Statamic will output the code as plaintext instead of attempting to run it, using the `noparse` modifier:

```html
<div class="content">
  {{ content | noparse }}
</div>
```