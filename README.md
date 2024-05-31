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

This is the contents of the published config file:

```php
return [
    'username' => env('DIRECTADMIN_USERNAME', 'admin'),
    'password' => env('DIRECTADMIN_PASSWORD', 'password'),
    'baseUrl' => env('DIRECTADMIN_BASE_URL'),
];
```

## Usage

```php
$result = Sensson\DirectAdmin\Facades\DirectAdmin::call('API_');
```

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
