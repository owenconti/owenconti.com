---
slug: posts/how-to-fix-phpunit-splitting-dots-onto-new-lines
title: 'How to Fix PHPUnit Splitting Dots onto New Lines'
type: post
category_slug: php
excerpt: 'Quick tip on how you can fix PHPUnit from splitting test output onto new lines.'
updated_at: 1590090208
created_at: 1590090208
---

If you see your PHPUnit outputting the test dots onto new lines like so:

```php
PHPUnit 8.5.3 by Sebastian Bergmann and contributors.

..
.
.
.
.                                                              6 / 6 (100%)
```

It usually means you have a line break before an opening PHP tag: `<?php` or after an ending PHP tag (if you use those): `?>`