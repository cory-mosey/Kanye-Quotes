<?php

namespace AvrilloCodeTest\ApiClient\Exceptions;

use Exception;

class ApiException extends Exception
{
    /**
     * Define the parameters for the exception.
     * 
     * @param string $message
     * @param ?int $code
     */
    public function __construct(string $message = '', ?int $code = null)
    {
        parent::__construct($message, $code ?? 0);
    }
}