<?php
namespace Gist\Analytics;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Excpetion\GuzzleException;
use GuzzleHttp\Exception\TransferException;
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
  public $query;

  /** @var GuzzleClient The guzzle http client used to make HTTP requests */
  public $guzzle;

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
        'headers' => [
          'Authorization' => $this->config['api_key']
        ],
        'timeout' => 20
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

      if ($this->query['type'] === "POST") {

        $options = [
          'json' => $this->query['params']
        ];
        // Create a PSR-7 request object and send
        $httpRequest = $this->guzzle->post($this->query['url'], $options);

      } else {

        $options = [
          'query' => $this->query['params']
        ];

        // Create a PSR-7 request object and send
        $httpRequest = $this->guzzle->request($this->query['type'], $this->query['url'], $options);

      }

      $response    = json_decode($httpRequest->getBody(), true);

    } catch(ClientException $e) {

      if ($e->getCode() == 401) {

        $response = [
          'error' => true,
          'message' => "Invalid API key. Please check the API docs for information on retrieving the correct API key.",
        ];

      } else {

        $response = [
          'error' => true,
          'message' => $e->getMessage(),
        ];

      }

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

    } catch(TransferException $e) {

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

    // Return the json
    return $response;

  }


  public function createRequest($requestType)
  {

    // Form the base query
    $this->query = [
      'params' => [],
      'url'    => "/api/events.json",
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
