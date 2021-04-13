<?php
namespace Gist\Analytics;

use Gist\Analytics\ConfigInterface;
use Gist\Analytics\Exception\ConfigurationException;

class Config implements ConfigInterface
{

  /** @var array Default request options */
  private $config;

  const APP_VERSION    = "1.0.0";

  const PRODUCTION_URL = "https://analytics.gist-apps.com";

  const DEVELOPMENT_URL = "https://localhost:8000";

  /**
  * Add the api key to the lookup request
  * "apiKey"
  *
  * @param Array $params
  *
  * @return Config
  */
  public function apiKey(Array $params)
  {

    if (isset($params['api_key']) && is_string($params['api_key'])) {
      $this->config['api_key'] = $params['api_key'];
    } else {
      throw new ConfigurationException("An API key must be included with the request to use Gist Analytics API");
    }

    return $this;

  }

  /**
  * Add the api key to the lookup request
  * "apiKey"
  *
  * @param Array $params
  *
  * @return Config
  */
  public function sandbox(Array $params)
  {

    if (isset($params['sandbox']) && is_bool($params['sandbox'])) {
      $this->config['sandbox'] = $params['sandbox'];
    } else {
      $this->config['sandbox'] = false;
    }

    return $this;

  }

  /**
  * Add the api key to the lookup request
  * "apiKey"
  *
  * @param Array $params
  *
  * @return Config
  */
  public function baseUri(Array $params)
  {

    if ($params['sandbox'] === true) {
      $this->config['base_uri'] = self::PRODUCTION_URL;
    } else {
      $this->config['base_uri'] = self::DEVELOPMENT_URL;
    }

    return $this;

  }


  /**
  * Get the private configuration object.
  *
  * @param Array $params ['api_key' => string, 'sandbox' => boolean]
  */
  public function configure(Array $params)
  {

    $this->apiKey($params);

    $this->sandBox($params);

    $this->baseUri();

    return $this->config;

  }

}
