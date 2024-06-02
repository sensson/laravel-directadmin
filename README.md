# DirectAdmin integration for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/sensson/laravel-directadmin.svg?style=flat-square)](https://packagist.org/packages/sensson/laravel-directadmin)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/sensson/laravel-directadmin/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/sensson/laravel-directadmin/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/sensson/laravel-directadmin/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/sensson/laravel-directadmin/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/sensson/laravel-directadmin.svg?style=flat-square)](https://packagist.org/packages/sensson/laravel-directadmin)

A simple DirectAdmin API for Laravel.

## Installation

You can install the package via composer:

```bash
composer require sensson/laravel-directadmin
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-directadmin-config"
```

The configuration file that will be published to your application's config 
directory is as follows:

```php
return [
    'server' => env('DIRECTADMIN_SERVER', 'https://server:2222'),
    'username' => env('DIRECTADMIN_USERNAME', 'admin'),
    'password' => env('DIRECTADMIN_PASSWORD', 'password'),
];
```

## Usage

Configure the DirectAdmin service by specifying the following environment 
variables. These variables are used to authenticate with DirectAdmin

- `DIRECTADMIN_SERVER`
- `DIRECTADMIN_USERNAME`
- `DIRECTADMIN_PASSWORD`

The username can be either an admin, reseller or user.

You can call any DirectAdmin API by using the `DirectAdmin` facade:

```php
$result = DirectAdmin::call('{DIRECTADMIN_API_CALL}');
```

This will return a `Collection` of the response data. 

If you want to become a different user, and you are authenticated as an admin
user, you can use the `become` method:

```php
$result = DirectAdmin::become('user')->call('{DIRECTADMIN_API_CALL}');
```

You can also call any DirectAdmin API command by passing it as method to 
the `DirectAdmin` facade like so:

```php
$result = DirectAdmin::CMD_API_DOMAIN_OWNERS();
```
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
