---
slug: posts/how-to-fix-query-execution-was-interrupted-with-aws-rds
title: 'How To Fix Query Execution Was Interrupted With AWS Rds'
type: post
category_slug: devops
excerpt: '"Query execution was interrupted" can sometimes be solved by increasing the storage size of your database.'
updated_at: 2022-10-09
created_at: 2022-10-09
---

During recent application deployment which involved a schema update to the database, we ran into the following error:

```
Query execution was interrupted (SQL: alter table `upload_records` add `row_index` int null)
```

What turned out to be the problem was that our AWS RDS instance was actually out of storage space. There was enough storage to continue daily operations, but not enough to add a new column to this table which has 20MM rows in it.

So the fix was easy: increase the available storage space for the RDS instance.
