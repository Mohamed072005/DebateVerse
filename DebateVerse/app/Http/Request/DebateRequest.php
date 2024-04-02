<?php

namespace App\Http\Request;

use Illuminate\Http\Request;

class DebateRequest
{
    public function validate(Request $request)
    {
        $request->validate([
            'content' => ['required', 'max:1000'],
            'categorie_name' => ['required'],
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
