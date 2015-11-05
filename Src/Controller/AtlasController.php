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
            echo json_decode([
                'error' => $ex->getMessage(),
                'error-code' => $ex->getCode()
            ]);
        }

        // Load the view to display the list of accomodations
        echo self::loadView('Accommodation/list', [
            'products' => $products
        ]);
    }
}