---
slug: posts/signing-aws-cloudfront-requests-with-laravel
title: 'Signing AWS CloudFront Requests with Laravel'
type: post
category_slug: laravel
excerpt: 'If you upload files to AWS S3 via your Laravel application, but want to restrict access to those files, you can do so using signed requests.'
updated_at: 1589852241
created_at: 1589852241
---

If you upload files to [AWS S3](https://aws.amazon.com/s3/) via your [Laravel](https://laravel.com/) application, but want to restrict access to those files, you can do so using signed requests.

Here's what the flow looks like:

* Upload a file to a protected (no public access) S3 bucket
* User makes a request to your application for the file
* Your application determines if the user is allowed to access the file
* If the user is allowed access to the file, the application creates a signed URL for the file
* The signed URL is returned to the user
* The user uses the signed URL to access the file

For most use cases, it makes sense to put a [CloudFront](https://aws.amazon.com/cloudfront/) distribution in front of your S3 bucket which will distribute your files to various edge locations across the world. We'll walk through how we can setup a S3 bucket and CloudFront distribution with access available only through signed requests.

This article will assume you have the following already configured:

* S3 bucket is setup with no public access
* A CloudFront distribution is setup with the S3 bucket configured as the origin
* You have a Laravel application with your AWS Access Key and Secret Key configured
* You are able to upload files to your S3 bucket via your Laravel application
* You have knowledge of AWS and can get around the AWS Console

### Update CloudFront origin's settings

The first thing we need to do is update the CloudFront origin settings to allow access to the S3 bucket:

![](/assets/aws-cloudfront-origin-settings.png)

* Restrict Bucket Access: **Yes**
* Origin Access Identity: **Create a New Identity**
* Grant Read Permissions on Bucket: **Yes, Update Bucket Policy** (this will update the S3 bucket's policy for you)

### Update CloudFront behaviour settings

Next, we need to tell the CloudFront distribution to accept signed requests.

![](/assets/aws-cloudfront-restrict-viewer-access.png)

* Restrict Viewer Access: **Yes**
* Trusted Signers: **Self **(Self means the current AWS account the CloudFront distribution belongs to)

### Verify the S3 bucket's policy was updated

In the first step, we selected "Yes, Update Bucket Policy". However, we should verify the policy was updated correctly:

```json
{
    "Version": "2008-10-17",
    "Id": "PolicyForCloudFrontPrivateContent",
    "Statement": [
        {
            "Sid": "1",
            "Effect": "Allow",
            "Principal": {
                "AWS": "arn:aws:iam::cloudfront:user/CloudFront Origin Access Identity XXXXXXX"
            },
            "Action": "s3:GetObject",
            "Resource": "arn:aws:s3:::XXXXXXXX/*"
        }
    ]
}
```

Alright, that's all we need to do on the AWS side, now onto updating your application.

### Set ENV variable for AWS_URL

We need to tell our application where it can find our CloudFront distribution. Update your `.env` file to include a variable for `AWS_URL`. The value should be the domain name of your CloudFront distribution:

```bash
AWS_URL=https://XXXXX.cloudfront.net
```

### Install package to sign requests

There's an awesome package available on GitHub which takes care of all the heavy lifting: [https://github.com/dreamonkey/laravel-cloudfront-url-signer](https://github.com/dreamonkey/laravel-cloudfront-url-signer)

Install the package by running:

```bash
composer require dreamonkey/laravel-cloudfront-url-signer
```

### Update your controller's logic to return a signed request

```php
<?php

$cloudfrontUrl = config('filesystems.disks.s3.url') . '/' . $filepath;
$signedUrl = CloudFrontUrlSigner::sign($cloudfrontUrl);

// You can either return the signed URL as string...
// return $signedUrl;

// or redirect the user to the file via the signed URL
return redirect($signedUrl);
```

By default, the `CloudFrontUrlSigner::sign` method will generate a signed URL that is valid for 1 day. Check out the GitHub page to see the various options you can pass to the `sign` method: [https://github.com/dreamonkey/laravel-cloudfront-url-signer](https://github.com/dreamonkey/laravel-cloudfront-url-signer)