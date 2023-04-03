<?php

namespace App\Exceptions;

use Exception;

class WompiException extends Exception
{
    protected $message;
    protected $code;

    public function __construct($message, $code)
    {
        parent::__construct();
        $this->message = $message;
        $this->code = $code;
    }


    public function render()
    {
        return response()->json(["message" => $this->message], $this->code);
    }
}
