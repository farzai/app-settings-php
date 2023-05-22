# PHP App setting

[![Latest Version on Packagist](https://img.shields.io/packagist/v/farzai/app-settings-php.svg?style=flat-square)](https://packagist.org/packages/farzai/app-settings-php)
[![Tests](https://img.shields.io/github/actions/workflow/status/farzai/app-settings-php/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/farzai/app-settings-php/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/farzai/app-settings-php.svg?style=flat-square)](https://packagist.org/packages/farzai/app-settings-php)

This open-source library provides a powerful and flexible way to manage application settings or configurations. It is designed with the principle of simplicity and adaptability, allowing developers to quickly set up and manage configurations in any PHP project.

## Installation

You can install the package via composer:

```bash
composer require farzai/app-settings
```

## Usage

```php
use Farzai\AppSettings\Setting;
use Farzai\AppSettings\Storage\FileStorage;

$setting = new Setting();

// Set a value
$setting->set('key', 'value');

// Get a value
$setting->get('key'); // value
```


Default storage is in temporary folder
You may change the storage driver like this
```php
// YourCustomStorageDriver implement \Farzai\AppSettings\Contracts\StorageRepositoryInterface::class
$setting = new Setting(new YourCustomStorageDriver());

// Or
$setting->setStorage(new YourCustomStorageDriver());
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [parsilver](https://github.com/parsilver)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
