<?php

namespace Baorv\Klaviyo\Exceptions;

use Throwable;

/**
 * Class ConfigurationException handles exceptions when configurations of input are wrong.
 *
 * @package Baorv\Klaviyo\Exceptions
 * @author baorv <roanvanbao@gmail.com>
 * @version 0.0.1
 */
class ConfigurationException extends \Exception
{

    /**
     * ConfigurationException constructor.
     *
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}