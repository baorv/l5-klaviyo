<?php

namespace Baorv\Klaviyo\Clients;

use Ixudra\Curl\Facades\Curl;
use Baorv\Klaviyo\Contracts\PublicApiContract;

/**
 * Class HttpClient
 *
 * @package Baorv\Klaviyo
 * @author baorv <roanvanbao@gmail.com>
 * @version 0.0.1
 */
class PublicApi implements PublicApiContract
{

    /**
     * Public key of this application
     *
     * @var string
     */
    protected $publicKey;

    /**
     * Base resource to request it
     *
     * @var string
     */
    protected $resourceApi = 'https://a.klaviyo.com';

    /**
     * PublicApi constructor.
     *
     * @param $publicKey
     */
    public function __construct($publicKey)
    {
        $this->publicKey = $publicKey;
    }

    /**
     * The main Events API endpoint is /api/track, which is used to track when someone takes an action or does something.
     *
     * @param $event
     * @param array $customer_properties
     * @param array $properties
     * @param null $timestamp
     *
     * @return mixed
     */
    public function track($event, $customer_properties = [], $properties = [], $timestamp = null)
    {
        $params = [
            'event' => $event,
            'properties' => $properties,
            'customer_properties' => $customer_properties
        ];
        if (!is_null($timestamp)) {
            $params['time'] = $timestamp;
        }
        return $this->makeRequest('api/track', $params);
    }

    /**
     * The Identify API endpoint is /api/identify, which is used to track properties about an individual without tracking an associated event
     *
     * @param $properties
     *
     * @return mixed
     */
    public function identify($properties)
    {
        $params = ['properties' => $properties];
        return $this->makeRequest('api/identify', $params);
    }

    /**
     * Build params with given information
     *
     * @param array $params
     *
     * @return string
     */
    protected function buildParams($params)
    {
        return 'data=' . urlencode(base64_encode(json_encode($params)));
    }

    /**
     * Make request to service
     *
     * @param string $path
     * @param array $params
     *
     * @return mixed
     */
    protected function makeRequest($path, $params = [])
    {
        $params = array_merge($params, [
            'token' => $this->publicKey
        ]);
        $url = $this->resourceApi . '/' . $path . '?' . $this->buildParams($params);
        $response = Curl::to($url)->get();
        return $response;
    }
}