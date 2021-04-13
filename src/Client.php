<?php
namespace Gist\Analytics;

use Gist\Analytics\Config;

/**
*  Analytics Client
*
*  The client class interacts with the Gist Analytics Platform to get and set
*  data.
*  Clients accept an array of constructor parameters.
*
*  Here's an example of creating a client using a base_uri and an array of
*  default request options to apply to each request:
*
*     $analytics = new Gist\Analytics\Client([
*         'api_key' => "123456789",
*         'sandbox' => false,
*     ]);
*
*  $event = $analytics->insert();
*
*  Use this section to define what this class is doing, the PHPDocumentator will use this
*  to automatically generate an API documentation using this information.
*
*  @author Zac Fair
*/
class Client extends ClientRequest implements ClientInterface {

  /** @var Array $config Default request options */
  private $config;

  /** @var GuzzleClient $guzzle Set up guzzle http client */
  public $guzzle;

  /**
  * @param Array $config Client configuration settings.
  */
  public function __construct(array $params = []) {

    $this->configure($params);
    $this->setupGuzzle();

  }


  /**
  * Configures the default options for a client.
  *
  * @param array $params
  */
  private function configure(array $params)
  {

    $config       = new Config();

    $this->config = $config->configure($params);

  }


  /**
  * Configures the default options for a client.
  *
  * @param string $option
  * @return string $this->config
  */
  protected function getConfig(string $option)
  {

    if (isset($this->config[$option])) {
      return $this->config[$option];
    }

  }

  /**
  * Query method
  *
  * This methods allows you to query the Gist Analytics API with your account
  *
  * @param string $name The name of the object you would like to query
  * @param DateTime $startDate The earliest date for your result set
  * @param DateTime $startDate The latest date for your result set
  * @param array $query
  * $query[value] Query the value of the results, allowing for specific filters
  * $query[operator] Query the value of the results, allowing for specific filters
  * @param array $meta The name of the object you would like to query
  * $meta[$metafieldName][value] Query the value of the results, allowing for specific filters
  * $meta[$metafieldName][operator] Query the value of the results, allowing for specific filters
  * @param string $format Choose from popular charting libraries // TODO: add support for libraries.
  *
  * @return array
  */
  public function query($name, $startDate, $endDate, $query = [], $meta = [], $format = "default") {

    // Get the request according the the endpoint.
    $req = $this->createRequest("query");

    $req
    ->addName($name)
    ->addStartDate($startDate)
    ->addEndDate($endDate)
    ->addQuery($query)
    ->addMeta($meta)
    ->addFormat($format)
    ;

    return $req->send();


  }


  /**
  * Insert method
  *
  * This methods allows you to query the Gist Analytics API with your account
  *
  * @param string $name The name of the record you would like to insert
  * @param string $value The value of the record you would like to insert
  * @param DateTime $startDate The latest date for your result set
  * @param array $query
  * $query[value] Query the value of the results, allowing for specific filters
  * $query[operator] Query the value of the results, allowing for specific filters
  * @param array $meta The name of the object you would like to query
  * $meta[$metafieldName][value] Query the value of the results, allowing for specific filters
  * $meta[$metafieldName][operator] Query the value of the results, allowing for specific filters
  * @param array $format Choose from popular charting libraries // TODO: add support for libraries.
  *
  * @return array
  */
  public function insert($name, $value, $meta = []) {

    // Get the request according the the endpoint.
    $req  = $this->createRequest("insert");

    $req
    ->addName($name)
    ->addValue($value)
    ->addMeta($meta)
    ;

    return $req->send();

  }


}
