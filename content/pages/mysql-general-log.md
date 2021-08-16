---
slug: posts/mysql-general-log
title: 'MySQL General Log'
type: post
category_slug: mysql
excerpt: 'Let''s run through how you can setup and configure the MySQL general log.'
video: fyZPlC6iSXI
updated_at: 1609787181
created_at: 1609787181
---

The general log records every query that the MySQL database processes, with the parameters visible. This means you are able to see the values used in a bound query.

There are two ways to enable the MySQL general log:

1. Enable it in the configuration file. This will enable the general log when MySQL starts.
2. You can run a global query to enable the general log while the MySQL server is running.

### Enable via configuration file

To enable the general log via the configuration file, add the following to your configuration file (example path is `/etc/my.cnf`):

```cnf
// my.cnf
[mysqld]
general_log = 1
log_output = 'table'
```

You must restart the MySQL server after editing the configuration file.

### Enable via a global query

To enable the general log via a global query, you can run this query:

```sql
SET global general_log = 1;
```

### General query log location

Now that the general log is enabled, you have a couple options on where the log is written to. By default, it’s written to a log file located at: `/var/log/mysql/mysql.log`

However, when I enable the general log for debugging, I often have the output written to a table, so I can query it easily. To write the output to a table, you can run this global query:

```sql
SET global log_output = 'table';
```

You can query the general log table via:

```sql
SELECT * FROM mysql.general_log;
```

The results returned can be filtered, sorted, etc:

```sql
SELECT * FROM mysql.general_log ORDER BY event_time DESC LIMIT 100;
```
