<?php

namespace Baorv\Klaviyo\Resources;

use Baorv\Klaviyo\Exceptions\ConfigurationException;

/**
 * Class Track
 *
 * @package Baorv\Klaviyo\Resources
 * @author baorv <roanvanbao@gmail.com>
 * @version 0.0.1
 */
class Track extends BasePublicResource
{

    /**
     * Track once key to retrieve
     */
    const TRACK_ONCE_KEY = '__track_once__';

    /**
     * The main Events API endpoint is /api/track, which is used to track when someone takes an action or does something.
     *
     * @param $event
     * @param array $customer_properties
     * @param array $properties
     * @param null $timestamp
     * @throws ConfigurationException
     * @return mixed
     */
    public function track($event, $customer_properties = [], $properties = [], $timestamp = null) {
        if ((!array_key_exists('$email', $customer_properties) || empty($customer_properties['$email']))
            && (!array_key_exists('$id', $customer_properties) || empty($customer_properties['$id']))) {

            throw new ConfigurationException('You must identify a user by email or ID.');
        }
        return $this->client->track($event, $customer_properties, $properties, $timestamp);
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
    public function trackOnce($event, $customer_properties = [], $properties = [], $timestamp = null) {
        $properties[self::TRACK_ONCE_KEY] = true;
        return $this->track($event, $customer_properties, $properties, $timestamp);
    }
}