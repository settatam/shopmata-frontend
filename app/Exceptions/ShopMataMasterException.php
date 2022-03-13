<?php

namespace App\Exceptions;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;
use Throwable;

class ShopMataMasterException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        if($message instanceof Exception) {
            parent::__construct($message->getMessage(), $message->getCode(), $message->getPrevious());
        } else {
            parent::__construct($message, $code, $previous);
        }
        Log::debug(Carbon::now()->toDateTimeString());
        Log::debug($this->getMessage());
        Log::debug($this->getTraceAsString());
    }
}
