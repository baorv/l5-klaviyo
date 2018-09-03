<?php

namespace Baorv\Klaviyo\Resources;

use Baorv\Klaviyo\Contracts\SecretApiContract;

/**
 * Class BaseResource
 *
 * @package Baorv\Klaviyo
 * @author baorv <roanvanbao@gmail.com>
 * @version 0.0.1
 */
abstract class BaseSecretResource
{

    /**
     * Client API
     *
     * @var SecretApiContract
     */
    protected $client;

    /**
     * BaseResource constructor.
     *
     * @param SecretApiContract $client
     */
    public function __construct(SecretApiContract $client)
    {
        $this->client = $client;
    }
}