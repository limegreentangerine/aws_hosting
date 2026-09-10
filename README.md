# AWS

ConcreteCMS tools for AWS deployments.

## Status

This package is currently in beta (`1.0.0-beta.1`). The package currently provides
a health-check endpoint and the scaffolding needed for additional AWS deployment
tools. AWS credentials, infrastructure provisioning, and service-specific
integrations are not configured by this package yet.

## Requirements

- PHP 8.4 or newer
- ConcreteCMS 9.5.0 or newer
- Composer
- Node.js and npm (only required for the JavaScript formatting checks)

## Installation

Install the package with Composer:

```bash
composer require limegreentangerine/aws
```

Then install and activate the **AWS** package from the ConcreteCMS dashboard.
The package handle is `aws`.

To work on the package from a checkout, install all PHP dependencies:

```bash
composer install
```

## AWS Elastic Beanstalk

The package includes Elastic Beanstalk configuration templates for PHP
settings, HTTP caching, and application log collection. After installing the
package in a ConcreteCMS project, copy the templates into the project's
`.ebextensions/` directory:

```bash
./vendor/bin/install-ebextensions
```

The command creates `.ebextensions/` when needed and does not overwrite
configuration files that already exist. Review the generated configuration
before deploying the project to Elastic Beanstalk.

## Health check

After the package is active, request:

```text
/aws/health
```

For example, if the site is running at `https://example.com`:

```bash
curl -i https://example.com/aws/health
```

The endpoint returns `200 OK` with the response body `OK`. It can be used
by an AWS load balancer or deployment monitor to verify that the ConcreteCMS
application and package are responding.

## Development

PHP source files are in `src/`, and PHPUnit tests belong in `tests/`. The package
uses the `Aws\` namespace for classes in `src/`.

Run the test suite:

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

The PHP formatter is PHP-CS-Fixer, and the JavaScript/Markdown formatter is
Prettier. JavaScript dependencies are installed with:

```bash
npm install
```

## Project layout

| Path                       | Purpose                                             |
| -------------------------- | --------------------------------------------------- |
| `controller.php`           | ConcreteCMS package metadata and route registration |
| `src/`                     | Package PHP classes                                 |
| `tests/`                   | PHPUnit tests                                       |
| `resources/.ebextensions/` | Elastic Beanstalk configuration templates           |
| `bin/install-ebextensions` | Installs the Elastic Beanstalk templates            |
| `composer.json`            | PHP dependencies and Composer scripts               |
| `package.json`             | Node.js tooling and Prettier configuration          |
| `.php-cs-fixer.dist.php`   | PHP-CS-Fixer configuration                          |

## License

This project is released under the [MIT License](https://opensource.org/license/mit/).
