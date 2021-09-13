---
slug: posts/copying-heroku-environment-variables-across-projects
title: 'Copying Heroku Environment Variables Across Projects'
type: post
category_slug: devops
excerpt: "Here's two quick commands you can use to copy Heroku environment variables across projects using the Heroku CLI."
updated_at: 2021-09-13
created_at: 2021-09-13
---

This article assumes you have the Heroku CLI installed and setup: https://devcenter.heroku.com/articles/heroku-cli

## Copying Heroku config to local file

Using the Heroku CLI you can copy all of the config variables out of a project into a local file:

```bash
heroku config -s -a {PROJECT_NAME} > config.txt
```

## Setting values from local file into Heroku project

You can also do the opposite, push config values into a Heroku project:

```bash
cat config.txt | tr '\n' ' ' | xargs heroku config:set -a {PROJECT}
```