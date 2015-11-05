<?php

namespace Src\Model;

use Curl\Curl;
use Src\Helpers\Cache;
use Src\Helpers\Config;

/**
 *
 * Grabs data from atlas API
 * Class Atlas
 * @see     http://govhack.atdw.com.au/API/api.html for API details
 *
 * @package Src\Model
 */
class Atlas {

    /**
     * Gets Category ID for given Category Desc
     * In the API the category DESC is similar to the category Name. For Instance : Category ID for the desc 'Accommodation' is 'ACCOMM'.
     * The result is cached for 5 minutes (Default cache time) to reduce http calls
     * @see http://govhack.atdw.com.au/API/categories.html
     *
     * @param String $categoryDesc Description(Name) of the category
     *
     * @return mixed
     * @throws \Exception
     */
    public static function getCategoryId($categoryDesc) {
        $key      = Config::getInstance()->get('atlas.api', 'key');
        $url      = Config::getInstance()->get('atlas.api', 'url');
        $resource = 'categories';

        $apiUrl   = $url . $resource;
        $response = Cache::get($apiUrl);

        if ($response == null) {
            $curl = new Curl();
            $curl->get($apiUrl, [
                'key' => $key
            ]);

            if ($curl->httpStatusCode >= 400) {
                throw new \Exception('Error requesting Atlas Category. Status : ' . $curl->httpStatusCode);
            }

            $response = $curl->response;
            Cache::set($apiUrl, $response);
        }

        foreach ($response->Category as $category) {
            if ($category->Description == $categoryDesc) {
                return (string) $category->CategoryId;
            }
        }

        throw new \Exception ('Could not find Category with desc : ' . $categoryDesc);
    }


    /**
     * Gets Products associated with provided parameters
     * @see http://govhack.atdw.com.au/API/queryproductsATWS.html
     *
     * @param array $params Filter Parameters like categoryId, Region Name etc
     *
     * @return mixed|null
     * @throws \Exception
     */
    public static function getProducts($params = array()) {

        $key      = Config::getInstance()->get('atlas.api', 'key');
        $url      = Config::getInstance()->get('atlas.api', 'url');
        $resource = 'products';

        $parameters = array_merge([
            'key' => $key
        ], $params);

        $apiUrl = $url . $resource . '?' . http_build_query($parameters);
        $response = Cache::get($apiUrl);

        if ($response == null) {
            $curl = new Curl();
            $curl->get($apiUrl);

            if ($curl->httpStatusCode >= 400) {
                throw new \Exception('Error requesting Atlas Products. Status : ' . $curl->httpStatusCode);
            }

            $response = $curl->response;
            Cache::set($apiUrl, $response);
        }

        return $response;
    }
}