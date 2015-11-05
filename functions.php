<?php

require_once(__DIR__.'/vendor/autoload.php');
use Src\Controller\AtlasController;

define('CALLED_FROM_FUNCTIONS', true);

// Routing Rules
if(!isset($_GET['action'])){
    echo json_encode([
        'error' => 'Action is missing in request parameter!'
    ]);
    return;
}

switch($_GET['action']){
    case 'listAll':
        ListAll();
        break;
    case 'detail':
        getProduct();
        break;
    default :
        ListAll();
}

function ListAll(){
    $atlasController = new AtlasController();
    $atlasController->index();
}

function getProduct(){
    $productId = $_GET['product-id'];
    $atlasController = new AtlasController();
    $atlasController->detail($productId);
}
