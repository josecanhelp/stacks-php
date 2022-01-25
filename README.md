# A PHP wrapper for the Stacks Blockchain API.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/josecanhelp/stacks-php.svg?style=flat-square)](https://packagist.org/packages/josecanhelp/stacks-php)
[![Tests](https://github.com/josecanhelp/stacks-php/actions/workflows/run-tests.yml/badge.svg?branch=main)](https://github.com/josecanhelp/stacks-php/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/josecanhelp/stacks-php.svg?style=flat-square)](https://packagist.org/packages/josecanhelp/stacks-php)

Interact with the Stacks blockchain using PHP.

## Installation

You can install the package via composer:

```bash
composer require josecanhelp/stacks-php
```

## Usage

```php
    $client = new Stacks\Stacks('http://localhost:3999');

    $client->recentTransactions(1);
```

```bash
array:4 [
  "limit" => 1
  "offset" => 0
  "total" => 177
  "results" => array:1 [
    0 => array:32 [
      "tx_id" => "0xb584d12cd17de6c129a89be8afea1b3cbdaf5b2f85acfe7b753f4811fec97f46",
      "nonce" => 165,
      "fee_rate" => "0",
      "sender_address" => "ST3Q96TFVE6E0Q91XVX6S8RWAJW5R8XTZ8YEBM8RQ",
      ...
    ]
  ]
]
```

## Testing

```bash
composer test
```

## Credits

-   [Jose Soto](https://github.com/josecanhelp)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
