<?php

namespace Src\Helpers;

/**
 * Loads the configuration data from ini file
 * Class Config
 * @package Src\Helpers
 */
class Config {

    /**
     * @var Config reference to singleton instance
     */
    private static $instance;

    /**
     * gets the instance via lazy initialization (created on first usage)
     *
     * @return Config
     */
    public static function getInstance() {
        if (null === static::$instance) {
            static::$instance = new static;
        }

        return static::$instance;
    }

    /**
     * This class is not allowed to call from outside: private!
     *
     */
    private function __construct() {
    }

    /**
     * prevent the instance from being cloned
     *
     * @return void
     */
    private function __clone() {
    }

    /**
     * prevent from being un-serialized
     *
     * @return void
     */
    private function __wakeup() {
    }

    /**
     * Gets the configuration value for given category and key
     * @param $category
     * @param $key
     *
     * @return mixed
     * @throws \Exception
     */
    public function get($category,$key) {

        // TODO: Replace config.ini with configurable variable when initializing the instance
        $iniArray = parse_ini_file(__DIR__.'../../config.ini',true);

        if(!isset($iniArray[$category][$key])) {
           throw new \Exception('Invalid configuration category/key !');
        }

        return $iniArray[$category][$key];
    }
}