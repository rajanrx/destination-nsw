<?php

namespace Src\Controller;


/**
 * Basic Controller Class
 * Class Controller
 * @package Src\Controller
 */
class Controller {

    /**
     * Renders the view using object buffer class and returns the view string
     *
     * @param  String $view
     * @param array   $data
     *
     * @return string
     * @throws \Exception
     */
    public static function loadView($view, $data = array()) {

        // Start object buffer to get the rendered screen implicitly
        ob_start();
        if (count($data)) {
            extract($data);
        }

        // Throw an exception if the view does not exist
        $file = __DIR__ . '/../View/' . trim($view, '.php') . ".php";
        if (!file_exists($file)) {
            throw new \Exception ('View ' . $file . ' does not exists');
        }

        // Include view file
        require_once($file);

        //Grab the rendered view string
        $renderedView = ob_get_contents();
        ob_end_clean();

        return $renderedView;
    }
}