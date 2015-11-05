<?php

namespace Src\Helpers;


use Gilbitron\Util\SimpleCache;

/**
 * Basic class to store the data in cache using filesystem
 * Uses SimpleCache library @see https://github.com/gilbitron/PHP-SimpleCache
 * Class Cache
 * @package Src\Helpers
 */
class Cache {

    /**
     * Default path for the cache
     */
    const CACHE_PATH = '/../../Cache/';

    /**
     * Default cache time
     */
    const CACHE_TIME = 3600;

    /**
     * Get the data from the cache .
     * Returns null if the data has already expired or cache does not exist.
     *
     * @param String $key Unique key to identify the cache value
     *
     * @return mixed|null
     */
    public static function get($key) {

        $cache = new SimpleCache();
        if ($data = $cache->get_cache($key)) {
            return json_decode($data);
        }

        return null;
    }

    /**
     * Set the cache value for given key.     *
     * If existing key is provided then the previous value gets overridden
     *
     * @param String $key       Unique key to identify the cache value
     * @param String $data      Value to be stored in the cache
     * @param int    $cacheTime Time after which cache expires
     * @param String $cachePath Path where cache needs to be stored
     */
    public static function set($key, $data, $cacheTime = self::CACHE_TIME, $cachePath = null) {

        if ($cachePath == null) {
            $cachePath = __DIR__ . self::CACHE_PATH;
        }

        $cache             = new SimpleCache();
        $cache->cache_path = $cachePath;
        $cache->cache_time = $cacheTime;

        $cache->set_cache($key, json_encode($data));
    }
}