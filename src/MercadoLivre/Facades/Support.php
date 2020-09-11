<?php


namespace App\Facades;


use Mockery\Exception;

class Support
{
    public function error(Exception $exception)
    {

        $error = [
            'message' => $exception->getMessage(),
            'code' => $exception->getCode(),
            'file' => $exception->getFile(),
            'line' => $exception->getLine()
        ];

        return response($error, $exception->getCode());
    }
}
