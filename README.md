#laravel-vtung 

[![Latest Version on Packagist](https://img.shields.io/packagist/v/codejutsu1/laravel-vtung.svg?style=flat-square)](https://packagist.org/packages/codejutsu1/laravel-vtung)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/codejutsu1/laravel-vtung/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/codejutsu1/laravel-vtung/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/codejutsu1/laravel-vtung/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/codejutsu1/laravel-vtung/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/codejutsu1/laravel-vtung.svg?style=flat-square)](https://packagist.org/packages/codejutsu1/laravel-vtung)

> An Elegant Laravel Package for vtu.ng

## Installation

To nstall the package via composer:

```bash
composer require codejutsu1/laravel-vtung
```
Setup the project using the command:

```bash
php artisan vtung:install
```

This command registers the service provider and publish the config file.

This is the contents of the published config file placed in the config folder:

```php
// config for Codejutsu1/LaravelVtuNg
return [
    /**
     * VTU username
     * 
     */
    'username' => env('VTU_USERNAME') ?? null,
    /**
     * VTU Password
     * 
     */
    'password' => env('VTU_PASSWORD') ?? null,
];

```

## Usage

```php
$vtu = new Codejutsu1\LaravelVtuNg\Vtu();
echo $vtu->echoPhrase('Hello, Codejutsu1\LaravelVtuNg!');
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

- [Daniel Dunu](https://github.com/codejutsu1)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
