<?php

namespace App\Exceptions;

use Exception;
use Twilio\Exceptions\ConfigurationException;
use Twilio\Exceptions\EnvironmentException;
use Twilio\Exceptions\TwilioException;
use Throwable;

class SMSException extends ShopMataMasterException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        if(($message instanceof TwilioException) && method_exists($message, 'getStatusCode')) {
            $this->code = $message->getStatusCode();
        }
    }
}
