# AWS Hosting

AWS deployment utilities for Concrete CMS.

The package currently provides a health-check endpoint and optional AWS
Elastic Beanstalk configuration templates. It does not provision AWS
infrastructure or configure AWS credentials.

## Requirements

- Concrete CMS 9.5.0 or newer
- PHP 8.4 or newer
- The `class_kit` Concrete CMS package

## Installation

Place the package in the Concrete CMS site's `packages/aws_hosting` directory,
then install and activate **AWS Hosting** from the Concrete CMS dashboard
under **Extend > Install**. The package handle is `aws_hosting`.

## Health check

When the package is active, the site responds to requests at:

```text
/aws/health
```

For example:

```bash
curl -i https://example.com/aws/health
```

The endpoint returns HTTP `200 OK` with the body `OK`. It can be used by a
load balancer or deployment monitor to check that the application is responding.

## AWS Elastic Beanstalk

The package includes `.ebextensions` templates for PHP settings, static asset
caching, and PHP-FPM error log collection. To copy the templates into the
Concrete CMS project, run this command from the project root after installing
the package:

```bash
./vendor/bin/install-ebextensions
```

The command creates `.ebextensions/` if needed and skips files that already
exist; it does not overwrite existing configuration. Review the resulting
files before deploying to Elastic Beanstalk.

## Development

Install the development dependencies with Composer:

```bash
composer install
```

Run the PHPUnit tests:

```bash
composer test
```

Check PHP and JavaScript formatting:

```bash
composer format:check
```

Apply the configured formatters:

```bash
composer format
```

## License

This project is licensed under the MIT License. See [LICENSE.TXT](LICENSE.TXT).
