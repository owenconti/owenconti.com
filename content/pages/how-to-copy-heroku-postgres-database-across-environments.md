---
slug: posts/how-to-copy-heroku-postgres-database-across-environments
title: 'How To Copy Heroku Postgres Database Across Environments'
type: post
category_slug: devops
excerpt: "Here's a one line command you can use to copy a Heroku Postgres database backup to a database in another environment."
updated_at: 2022-04-04
created_at: 2022-04-04
---

If you find yourself needing to copy a database across environments (say production to staging) you can use this one line command from Heroku:

```
heroku pg:backups:restore {original_env}::{backup_id} {DATABASE_URL} --app {new_env}
```

Where:

- `original_env` is the name of the environment you are pulling the backup from
- `backup_id` is the ID of the backup, found on the Durability tab of the Heroku Postgres database page
- `DATABASE_URL` is the env var that Heroku generated for the new database
- `new_env` is the new application ID that has the `DATABASE_URL` attached to ti