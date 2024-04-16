<?php

namespace App\Exceptions\Repositories\Pterodactyl;

use Exception;

class ServerNotFoundException extends Exception
{
    public function __construct($message = 'Server not found', $code = 404, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}