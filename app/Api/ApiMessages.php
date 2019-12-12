<?php

namespace App\Api;

class ApiMessages
{
    private $msg = [];

    public function __construct(string $message, array $data = [])
    {
        $this->msg['message']  = $message;
        $this->msg['errors'] = $data;
    }

    public function getMessage()
    {
        return $this->msg;
    }
}
