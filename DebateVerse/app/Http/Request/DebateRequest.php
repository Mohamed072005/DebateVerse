<?php

namespace App\Http\Request;

use Illuminate\Http\Request;

class DebateRequest
{
    private  static $instance = null;

    private function __construct(){}

    public static function getInstance(){
        if
        (self::$instance === null){
            self::$instance = new DebateRequest();
        }
        return self::$instance;
    }
    public function validate(Request $request)
    {
        $request->validate([
            'content' => ['required', 'max:1000'],
            'img' => ['image', 'max:2048']
        ]);
    }

    public function validateReport(Request $request)
    {
        $request->validate([
            'report' => ['required', 'string']
        ]);
    }
}
