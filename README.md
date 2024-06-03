# DirectAdmin integration for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/sensson/laravel-directadmin.svg?style=flat-square)](https://packagist.org/packages/sensson/laravel-directadmin)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/sensson/laravel-directadmin/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/sensson/laravel-directadmin/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/sensson/laravel-directadmin/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/sensson/laravel-directadmin/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/sensson/laravel-directadmin.svg?style=flat-square)](https://packagist.org/packages/sensson/laravel-directadmin)

PHP library for interacting with the DirectAdmin API in Laravel.

## Installation

You can install the package via composer:

```bash
composer require sensson/laravel-directadmin
php artisan vendor:publish --tag="laravel-directadmin-config"
```

## Usage

You will need the following credentials to authenticate:

- `DIRECTADMIN_SERVER`
- `DIRECTADMIN_USERNAME`
- `DIRECTADMIN_PASSWORD`

### A simple example

You can call any DirectAdmin API by using the `DirectAdmin` facade:

```php
<?php
use Sensson\DirectAdmin\Facades\DirectAdmin;

$result = DirectAdmin::post('{DIRECTADMIN_API_CALL}', []);
$result = DirectAdmin::get('{DIRECTADMIN_API_CALL}', []);
```

The first parameter is the API command you want to call. The second parameter
is an array of parameters that will be passed to the API as well. This is
optional and by default an empty array is used.

You can use the `post` or `get` method to call the API.

### JSON API

We also support the new JSON API. For example, to get the admin usage, you can
use the following command:

```php
$result = DirectAdmin::get('api/admin-usage', []);
```

### Impersonation

If you want to run an API call as a different user, and you are authenticated as 
an admin or reseller, you can use the `become` method:

```php
$result = DirectAdmin::become('user')->post('{DIRECTADMIN_API_CALL}');
```

This will run the `DIRECTADMIN_API_CALL` as the user `user`.

### Debugging

You can enable debugging by calling the `debug` method:

```php
$result = DirectAdmin::debug()->post('{DIRECTADMIN_API_CALL}', []);
```

This will enable debugging for the HTTP request. This can help you identify
issues with the DirectAdmin server.

### More information

For more information on the available commands, please refer to the 
[DirectAdmin API documentation](https://docs.directadmin.com/directadmin/customizing-workflow/api-all-about.html).

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Sensson](https://github.com/Sensson)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
