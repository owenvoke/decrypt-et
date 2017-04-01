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