<?php
namespace Gist\Analytics;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Excpetion\GuzzleException;

/**
*  Analytics Client Request class
*
*  Use this section to define what this class is doing, the PHPDocumentator will use this
*  to automatically generate an API documentation using this information.
*
*  @author Zac Fair
*/
class ClientRequest implements ClientRequestInterface {

  /** @var Array $query Array of data used to make the http request */
  private $query;

  /** @var GuzzleClient The guzzle http client used to make HTTP requests */
  private $guzzle;

  /**
  * Set up the Guzzle Http Client
  * http://docs.guzzlephp.org/en/stable/overview.html
  *
  * @return GuzzleClient The guzzle http client used to make HTTP requests
  */
  public function setupGuzzle()
  {

    $this->guzzle = new GuzzleClient([
        'base_uri' => $this->config['base_uri'],
    ]);

  }

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
  public function send()
  {

    $response = null;

    try {

      // Create a PSR-7 request object and send
      $httpRequest = $this->guzzle->request($this->query['type'], $this->query['url'], $this->query['params']);

      $response    = json_decode($httpRequest->getBody(), true);

    } catch(ClientException $e) {

      $response = [
        'error' => true,
        'message' => $e->getMessage(),
      ];

    } catch(RequestException $e) {

      $response = [
        'error' => true,
        'message' => $e->getMessage(),
      ];

    } catch(GuzzleException $e) {

      $response = [
        'error' => true,
        'message' => $e->getMessage(),
      ];

    }

    if (is_null($response)) {

      $response = [
        'error' => true,
        'message' => "An unknown error occured",
        'code' => 500
      ];

    }
    //
    // if (self::PRINT_REQUEST === true) {
    //   echo "<pre><code>";
    //   echo json_encode($response, JSON_PRETTY_PRINT);
    //   echo "</code></pre>";
    //   echo "<br/>";
    // }
    // Return the json
    return $response;

  }

  public function createRequest($requestType)
  {

    $this->query = [
      'params' => [],
      'url'    => $this->config['base_uri'],
      'type'   => $requestType === "insert" ? "POST" : "GET"
    ];

    return $this;

  }

  public function addName($name)
  {

    $this->query['params']['name'] = $name;

    return $this;

  }

  public function addValue($value)
  {

    $this->query['params']['value'] = $value;

    return $this;

  }

  public function addQuery($query)
  {

    $this->query['params']['query'] = $query;

    return $this;

  }


  public function addMeta($meta)
  {

    $this->query['params']['meta'] = $meta;

    return $this;

  }

  public function addStartDate($startDate)
  {

    $this->query['params']['start_date'] = $startDate;

    return $this;

  }

  public function addEndDate($endDate)
  {

    $this->query['params']['end_date'] = $endDate;

    return $this;

  }

  public function addFormat($format)
  {

    $this->query['params']['format'] = $format;

    return $this;

  }



}
