---
slug: posts/laravel-forge-fails-to-provision-servers-on-aws
title: 'Laravel Forge Fails to Provision Servers on AWS'
type: post
category_slug: laravel
excerpt: 'There''s a common problem when using Laravel Forge to provision servers on AWS.'
updated_at: 1588524037
created_at: 1588524037
---

If you're running into issues with Laravel Forge failing to provision your server when using AWS, chances are there is an easy fix.

When provisioning a new server from within the Laravel Forge UI, Forge will default to creating a new VPC for your server. This is great because it means Forge sets up the VPC the way it wants. However, if you happen to ask Forge to use the default VPC that is created with your AWS account, you'll run into a problem where Forge fails to provision the server, and then just deletes the server from Forge.

The issue with the default VPC in AWS is that the default security group it uses only allows inbound traffic from within that security group. This essentially tells AWS to keep everything within the VPC as private (no outside access). Since the Forge servers are located outside of your VPC, Forge is unable to make contact with your new server, so it thinks it failed to provision.

### The fix

You have two options for a fix:

1. Allow Forge to create a new VPC

2. If you insist on using the default VPC, change the security group to allow inbound traffic from anywhere instead of from within the security group