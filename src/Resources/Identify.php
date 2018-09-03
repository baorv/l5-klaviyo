<?php

namespace Baorv\Klaviyo\Resources;

use Baorv\Klaviyo\Exceptions\ConfigurationException;

/**
 * Class Identify
 *
 * @package Baorv\Klaviyo\Resources
 * @author baorv <roanvanbao@gmail.com>
 * @version 0.0.1
 */
class Identify extends BasePublicResource
{

    /**
     * The Identify API endpoint is /api/identify, which is used to track properties about an individual without tracking an associated event
     *
     * @param $properties
     * @throws ConfigurationException
     * @return mixed
     */
    public function identify($properties) {
        if ((!array_key_exists('$email', $properties) || empty($properties['$email']))
            && (!array_key_exists('$id', $properties) || empty($properties['$id']))) {
            throw new ConfigurationException('You must identify a user by email or ID.');
        }
        return $this->client->identify($properties);
    }
}