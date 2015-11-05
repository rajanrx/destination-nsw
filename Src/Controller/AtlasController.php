<?php

namespace Src\Controller;

use Src\Model\Atlas;

if(!defined('CALLED_FROM_FUNCTIONS')){
    die("No direct access to the controller");
}

/**
 * Controller for retrieving Atlas data
 * Class AtlasController
 * @package Src\Controller
 */
class AtlasController extends  Controller{

    /**
     * @throws \Exception
     */
    public function index(){

        $products = null;

        try {
            // Get the category Id for 'Accommodation'
            $accommodationCatId = Atlas::getCategoryId('Accommodation');

            // Get the products specifically for 'Blue Mountains' region belonging to category 'Accommodation'
            $products = Atlas::getProducts([
                'cats' => $accommodationCatId,
                'rg'   => 'Blue Mountains'
            ]);
        }
        catch (\Exception $ex) {
            echo json_encode([
                'error' => $ex->getMessage(),
                'error-code' => $ex->getCode()
            ]);
            return;
        }

        // Load the view to display the list of accomodations
        echo self::loadView('Accommodation/list', [
            'products' => $products
        ]);
    }

    public function detail($productId){

        $product = null;
        if(empty($productId)){
            echo json_encode([
                'error' => 'Missing product ID !',
                'error-code' => 400
            ]);
            return;
        }

        try {
            $product = Atlas::getProduct($productId);
        }
        catch (\Exception $ex) {
            echo json_encode([
                'error' => $ex->getMessage(),
                'error-code' => $ex->getCode()
            ]);
            return;
        }

        // Load the view to display accommodation detail
        echo self::loadView('Accommodation/detail', [
            'product' => $product->product_distribution->product_record,
            'multimedia' => $product->product_distribution->product_multimedia,
            'address' => $product->product_distribution->product_address
        ]);
    }
}