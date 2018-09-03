<?php

namespace Baorv\Klaviyo\Resources;

use Baorv\Klaviyo\Contracts\PublicApiContract;

/**
 * Class BaseResource
 *
 * @package Baorv\Klaviyo
 * @author baorv <roanvanbao@gmail.com>
 * @version 0.0.1
 */
abstract class BasePublicResource
{

    /**
     * Client API
     *
     * @var PublicApiContract
     */
    protected $client;

    /**
     * BaseResource constructor.
     *
     * @param PublicApiContract $client
     */
    public function __construct(PublicApiContract $client)
    {
        $this->client = $client;
    }
}