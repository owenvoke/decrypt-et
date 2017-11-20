# decrypt-et

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Style CI][ico-styleci]][link-styleci]
[![Code Coverage][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

A tool for decrypting ExtraTorrent's js-based page encryption.

## Structure

```
src/
tests/
vendor/
```

## Install

Via Composer

``` bash
$ composer require pxgamer/decrypt-et
```

## Usage

This is primarily to be used when creating a proxy of ET content.

It is a quick project to decrypt the encrypted content on ExtraTorrent pages.

```php
use pxgamer\DecryptET\Decrypt;

$Decrypt = new Decrypt();

// Fetch the page content from ET (alternatively you can set the HTML manually using $this->__set('full_page', $value)
$Decrypt->fetch();

// Populate the JSON class with the values from the JSON in Decrypt->full_page
$Decrypt->populate();

// Decrypt the content
$Decrypt->decrypt();

// Output the decrypted content
echo $Decrypt->__get('decrypted');
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.

## Security

If you discover any security related issues, please email owzie123@gmail.com instead of using the issue tracker.

## Credits

- [pxgamer][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/pxgamer/decrypt-et.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/pxgamer/decrypt-et/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/86949088/shield
[ico-code-quality]: https://img.shields.io/codecov/c/github/pxgamer/decrypt-et.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/pxgamer/decrypt-et.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/pxgamer/decrypt-et
[link-travis]: https://travis-ci.org/pxgamer/decrypt-et
[link-styleci]: https://styleci.io/repos/86949088
[link-code-quality]: https://codecov.io/gh/pxgamer/decrypt-et
[link-downloads]: https://packagist.org/packages/pxgamer/decrypt-et
[link-author]: https://github.com/pxgamer
[link-contributors]: ../../contributors
