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
interface ClientRequestInterface
{


  /**
  * Set up the Guzzle Http Client
  * http://docs.guzzlephp.org/en/stable/overview.html
  *
  * @return GuzzleClient The guzzle http client used to make HTTP requests
  */
  function setupGuzzle();


  /**
  * Send an HTTP request.
  *
  * @var RequestInterface $params Request to send
  *
  * @return ResponseInterface
  * @throws GuzzleException
  * @throws ClientException
  * @throws RequestException
  */
  function send();

}
