<?php

namespace App\Http\Request;

use Illuminate\Http\Request;

class MessageRequest
{
    private static $instance = null;

    private function __construct(){}

    public static function getInstance()
    {
        if(self::$instance === null){
            self::$instance = new MessageRequest();
        }
        return self::$instance;
    }

    public function validateMessage(Request $request)
    {
        $request->validate([
            'message' => 'required',
        ]);
    }
}
