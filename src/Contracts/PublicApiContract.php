<?php

namespace Baorv\Klaviyo\Contracts;

/**
 * Class HttpClientContract
 *
 * @package Baorv\Klaviyo\Contracts
 * @author baorv <roanvanbao@gmail.com>
 * @version 0.0.1
 */
interface PublicApiContract
{

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
    public function track($event, $customer_properties = [], $properties = [], $timestamp = null);

    /**
     * The Identify API endpoint is /api/identify, which is used to track properties about an individual without tracking an associated event
     *
     * @param $properties
     *
     * @return mixed
     */
    public function identify($properties);
}