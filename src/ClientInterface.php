<?php
namespace Gist\Analytics;

use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;

/**
 * Client interface for sending HTTP requests.
 */
interface ClientInterface
{

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
  public function query($name, $startDate, $endDate, $query = [], $meta = [], $format = "default");

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
  public function insert($name, $value, $meta = []);
  

}
