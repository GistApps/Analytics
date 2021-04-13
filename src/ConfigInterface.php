<?php
namespace Gist\Analytics;

/**
 * Object interface to configure the Gist Analytics API
 * [
 *         'api_key' => "123456789",
 *         'sandbox' => true, ** optional
 * ]
 */
interface ConfigInterface
{

    /**
     * Add the api key to the lookup request
     * "apiKey"
     *
     * @param String $apiKey
     *
     * @return Config
     */
    public function apiKey(Array $params);


    /**
     * Add the api key to the lookup request
     * "sandbox"
     *
     * @param String $sandbox
     *
     * @return Config
     */
    public function configure(Array $params);

}
