---
slug: posts/productive-alfred-workflows-for-developers
title: 'Productive Alfred workflows for developers'
type: post
category_slug: tips
excerpt: "I've recently started using Alfred again as my global command palette on my machine. In this article, I'll go over a list of some of the workflows I use on a daily basis, and how they work."
updated_at: 2022-07-07
created_at: 2022-07-07
---

Before we begin, please note that some of these workflows may be specific to the tools and technologies I use. Even if you don't use these tools yourself, you may still find the workflows can be useful for your daily work.

Also, it is worth noting that I have customized most, if not all, of the keywords for these workflows to make them shorter to type and easier to remember. I recommend you take the time to customize the keywords to what works for you.

That being said, let's get into the list!

## 1Password

[https://www.alfredapp.com/help/features/1password/](https://www.alfredapp.com/help/features/1password/)

I use 1Password as my password manager. There's a workflow created by the Alfred App team to integrate 1Password with Alfred. This workflow will allow you to search for items in your 1Password vault from anywhere on your machine.

To search, you can use the `1p {searchTerm}` command:

![1Password Alfred workflow](/assets/alfred-workflows/1password-wondershare.gif)

## Laravel Forge

[https://github.com/vmitchell85/alforge](https://github.com/vmitchell85/alforge)

I use Laravel Forge to provision and manage Laravel projects that I work on. Although the Forge workflow offers a lot of functionality, I mainly use it to open servers/sites in my browser.

To open a server, use the `forge open {server}` command:

![Laravel Forge Alfred workflow](/assets/alfred-workflows/forge-open-workflow.gif)

## AWS Console Services

[https://github.com/rkoval/alfred-aws-console-services-workflow](https://github.com/rkoval/alfred-aws-console-services-workflow)

This workflow is very useful for quickly navigating AWS Console services. If you're familiar with the AWS Console, you know that it can be painful to navigate to a specific resource. With this workflow, you can open your browser directly to any resource you wish!

To use the workflow to open an AWS resource, type `aws {service} {sub-service} {resource}` - for example: `aws ec2 instances my-instance`:

![AWS Console Alfred workflow](/assets/alfred-workflows/aws-rds-instances-workflow.gif)

## Datadog

[https://github.com/nekottyo/alfred-datadog-workflow](https://github.com/nekottyo/alfred-datadog-workflow)

Much like the first three workflows, this Datadog workflow is very useful for quickly navigating Datadog. I primarily use it for opening my custom dashboards.

To open a dashboard, use the `dd dashboard {dashboard}` command:

![Datadog Alfred workflow](/assets/alfred-workflows/datadog-workflow.gif)

## Documentation

I have a few different documentation-based worfklows installed. I won't go over each one in detail, but they all do pretty much the same thing: allow you to search documentation for specific technologies via Alfred.

- [Laravel Documentation](https://github.com/tillkruss/alfred-laravel-docs)
- [Machine Learning Documentation](https://github.com/lsgrep/mldocs)
- [DevDocs Documentation](https://github.com/yannickglt/alfred-devdocs)

The DevDocs documentation workflow is the most useful one for me. It allows you to search for documentation for any technology available on [devdocs.io](https://devdocs.io/). The minor caveat is that you need to ensure you add each technology you want to search against.

To search DevDocs, you can type `doc {searchTerm}`:

![DevDocs Alfred workflow](/assets/alfred-workflows/devdocs-workflow.gif)

## Faker

[https://github.com/zenorocha/alfred-workflows#faker-v100--download](https://github.com/zenorocha/alfred-workflows#faker-v100--download)

This workflow is very useful for generating fake data. It's a simple workflow that allows you to generate fake data for any field you want.

To generate fake data using the workflow, you can use type `faker {field}`, the generated data will be copied to your clipboard:

![Faker Alfred workflow](/assets/alfred-workflows/faker-workflow.gif)

## GitHub

If you're a GitHub user (especially for work) this workflow makes opening GitHub repos super easy.

To open a GitHub repo, type `gh {repo}`:

![GitHub Alfred workflow](/assets/alfred-workflows/github-workflow.gif)

## JIRA

[https://github.com/jackchuka/alfred-workflow-jira](https://github.com/jackchuka/alfred-workflow-jira)

I haven't found this one to be super useful yet, but I can see it being handy when discussing JIRA issues with peers. Rather than opening JIRA in your browser and then searching for the issue number, you can open an issue directly from Alfred.

To open a JIRA issue, type `jiraf {issue}` and then use the `browse` command:

![JIRA Alfred workflow](/assets/alfred-workflows/jira-workflow.gif)

## Network Tools

[https://github.com/fniephaus/alfred-network/](https://github.com/fniephaus/alfred-network/)

The Network Tools workflow provides a few handy networking tools that you'd otherwise have to open a terminal session for:

- flush DNS cache
- ping a host
- trace route to a host
- nslookup a host

![Networking Tools Alfred workflow](/assets/alfred-workflows/networking-tools-workflow.gif)

## Notion Search

[https://github.com/wrjlewis/notion-search-alfred-workflow/](https://github.com/wrjlewis/notion-search-alfred-workflow/)

This Notion Search workflow is _extremely_ useful to quickly open Notion documents. I find it difficult to navigate Notion, especially when you're trying to a find a document that you don't know where it exists.

To quickly open a Notion document, type `ns {searchTerm}`:

![Notion Search workflow](/assets/alfred-workflows/notion-search-workflow.gif)

## PHP Monitor

[https://github.com/nicoverbruggen/phpmon/blob/main/README.md#%EF%B8%8F-launchers-alfred-raycast](https://github.com/nicoverbruggen/phpmon/blob/main/README.md#%EF%B8%8F-launchers-alfred-raycast)

If you use PHP Monitor (phpmon) to manage your local PHP environment, you can use this workflow to quickly interact with PHP Monitor.

To switch PHP versions, type `pm version {version}`:

![PHP Monitor workflow](/assets/alfred-workflows/php-monitor-workflow.gif)

## TablePlus

[https://www.packal.org/workflow/tableplus](https://www.packal.org/workflow/tableplus)

This workflow is very useful for quickly opening TablePlus connections. I've found it works best when you have a connection created per database that you want to connect to, that way you can open directly to the specific database.

To open a connection, type `tp {connection}`:

![TablePlus workflow](/assets/alfred-workflows/tableplus-workflow.gif)

---

That is the list of my productivity Alfred workflows as of July 2022. I have a few more workflows installed for various tasks such as interacting with Spotify, checking the weather, looking up synonyms, etc.