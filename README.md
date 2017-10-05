# decrypt-et

A tool for decrypting ExtraTorrent's js-based page encryption.

[![Version](https://img.shields.io/packagist/v/pxgamer/decrypt-et.svg)](https://packagist.org/p/pxgamer/decrypt-et)
[![License](https://img.shields.io/packagist/l/pxgamer/decrypt-et.svg)](https://opensource.org/licenses/mit-license)

This is primarily to be used when creating a proxy of ET content.

It is a quick project to decrypt the encrypted content on ExtraTorrent pages.

## Example

```php
<?php

require '../vendor/autoload.php';

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