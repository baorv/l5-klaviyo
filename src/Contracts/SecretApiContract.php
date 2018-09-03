<?php

namespace Baorv\Klaviyo\Contracts;

/**
 * Class ClientApiContract
 *
 * @package Baorv\Klaviyo\Contracts
 * @author baorv <roanvanbao@gmail.com>
 * @version 0.0.1
 */
interface SecretApiContract
{
    /**
     * GET method for client api
     *
     * @param $url
     * @param array $params
     *
     * @return mixed
     */
    public function get($url, $params = []);

    /**
     * POST method for client api
     *
     * @param $url
     * @param array $params
     *
     * @return mixed
     */
    public function post($url, $params = []);

    /**
     * PUT method for client api
     *
     * @param $url
     * @param array $params
     *
     * @return mixed
     */
    public function put($url, $params = []);

    /**
     * DELETE method for client api
     *
     * @param $url
     * @param array $params
     *
     * @return mixed
     */
    public function delete($url, $params = []);

    /**
     * Parse json to object
     *
     * @param string $json
     * @return \stdClass
     */
    public function parseJsonToObject($json);
}