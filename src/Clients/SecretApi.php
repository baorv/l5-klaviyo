<?php

namespace Baorv\Klaviyo\Clients;

use Baorv\Klaviyo\Contracts\SecretApiContract;
use Ixudra\Curl\Facades\Curl;
use Baorv\Klaviyo\Exceptions\KlaviyoApiException;

/**
 * Class ClientApi
 *
 * @package Baorv\Klaviyo
 * @author baorv <roanvanbao@gmail.com>
 * @version 0.0.1
 */
class SecretApi implements SecretApiContract
{

    /**
     * The request completed successfully.
     */
    const HTTP_OK = 200;

    /**
     * Request is missing or has a bad parameter.
     */
    const BAD_REQUEST = 400;

    /**
     * Request is missing or has an invalid API key.
     */
    const NOT_AUTHORIZED = 400;

    /**
     * The requested resource doesn't exist.
     */
    const NOT_FOUND = 404;

    /**
     * Something is wrong on Klaviyo's end.
     */
    const INTERNAL_ERROR = 500;

    /**
     * API key using in this application
     *
     * @var string
     */
    protected $apiKey;

    /**
     * Base resource to request it
     *
     * @var string
     */
    protected $resourceApi = 'https://a.klaviyo.com';

    /**
     * Current module of this resource
     *
     * @var string
     */
    protected $moduleApi = 'v1';

    /**
     * ClientApi constructor.
     *
     * @param string $apiKey
     */
    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * GET method for client api
     *
     * @param $url
     * @param array $params
     * @throws KlaviyoApiException
     * @return mixed
     */
    public function get($url, $params = [])
    {
        $response = Curl::to($this->makeUrl($url))->withData($this->buildParams($params))->returnResponseObject()->get();
        if ($response->status != self::HTTP_OK) {
            $response = $this->parseJsonToObject($response->content);
            throw new KlaviyoApiException($response->message);
        }
        return $this->parseJsonToObject($response->content);
    }

    /**
     * POST method for client api
     *
     * @param $url
     * @param array $params
     * @throws KlaviyoApiException
     * @return mixed
     */
    public function post($url, $params = [])
    {
        $response = Curl::to($this->makeUrl($url))->withData($this->buildParams($params))->returnResponseObject()->post();
        if ($response->status != self::HTTP_OK) {
            $response = $this->parseJsonToObject($response->content);
            throw new KlaviyoApiException($response->message);
        }
        return $this->parseJsonToObject($response->content);
    }

    /**
     * PUT method for client api
     *
     * @param $url
     * @param array $params
     * @throws KlaviyoApiException
     * @return mixed
     */
    public function put($url, $params = [])
    {
        $response = Curl::to($this->makeUrl($url))->withData($this->buildParams($params))->returnResponseObject()->put();
        if ($response->status != self::HTTP_OK) {
            $response = $this->parseJsonToObject($response->content);
            throw new KlaviyoApiException($response->message);
        }
        return $this->parseJsonToObject($response->content);
    }

    /**
     * DELETE method for client api
     *
     * @param $url
     * @param array $params
     * @throws KlaviyoApiException
     * @return mixed
     */
    public function delete($url, $params = [])
    {
        $response = Curl::to($this->makeUrl($url))->withData($this->buildParams($params))->returnResponseObject()->delete();
        if ($response->status != self::HTTP_OK) {
            $response = $this->parseJsonToObject($response->content);
            throw new KlaviyoApiException($response->message);
        }
        return $this->parseJsonToObject($response->content);
    }

    /**
     * Build params for executing requests
     *
     * @param array $params
     *
     * @return array
     */
    protected function buildParams($params = [])
    {
        $params = array_merge($params, [
            'api_key' => $this->apiKey
        ]);
        return $params;
    }

    /**
     * Make URL before requesting
     *
     * @param string $url
     *
     * @return string
     */
    protected function makeUrl($url)
    {
        return $this->resourceApi . '/api/' . $this->moduleApi . '/' . $url;
    }

    /**
     * Parse json to object
     *
     * @param string $json
     * @return \stdClass
     */
    public function parseJsonToObject($json)
    {
        return json_decode($json);
    }
}