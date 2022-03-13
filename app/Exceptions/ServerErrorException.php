<?php

namespace App\Exceptions;

class ServerErrorException extends ShopMataMasterException
{
    public function render($request)
    {
        return response(['message' => $this->getMessage(), 'status' => 'failed'], 500);
    }
}
