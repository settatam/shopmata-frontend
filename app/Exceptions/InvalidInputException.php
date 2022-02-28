<?php

namespace App\Exceptions;

class InvalidInputException extends ShopMataMasterException
{
    public function render($request)
    {
        return response(['message' => $this->getMessage(), 'status' => 'error'], 400);
    }
}
