<?php

namespace App\Exceptions\Repositories\Pterodactyl;

use Exception;

class ServerCreationFailedException extends Exception
{
    public function __construct($message = 'Server creation failed', $code = 500, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}