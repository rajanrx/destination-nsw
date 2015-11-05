<?php

use Src\Helpers\Config;
use Src\Model\Atlas;

require_once(__DIR__.'/../../vendor/autoload.php');

// Check if the configuration value can be loaded
echo Config::getInstance()->get('atlas.api','key')."\n\n";

// Check if category ID can be fetched from the Atlas API
echo Atlas::getCategoryId('Accommodation')."\n\n";

// Check if products with params can be fetched from the Atlas API
$products = Atlas::getProducts([
    'cats' => 'ACCOMM',
    'rg'   => 'Blue Mountains'
]);

//print_r($products);

$product = Atlas::getProduct('9053120$53072421-f579-4ebe-822f-086c91455403');

print_r($product);