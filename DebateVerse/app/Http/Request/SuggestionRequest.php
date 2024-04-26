<?php

namespace App\Http\Request;

use Illuminate\Http\Request;

class SuggestionRequest
{
    private static $instance = null;

    private function __construct(){}

    public static function getInstance(){
        if(self::$instance === null){
            self::$instance = new SuggestionRequest();
        }
        return self::$instance;
    }

    public function validateRequest(Request $request)
    {
        $request->validate([
            'message' => ['required', 'max:300', 'min:10'],
        ]);
    }
}
