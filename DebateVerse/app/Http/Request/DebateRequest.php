<?php

namespace App\Http\Request;

use Illuminate\Http\Request;

class DebateRequest
{
    public function validate(Request $request)
    {
        $request->validate([
            'content' => ['required', 'max:1000'],
            'categorie_name' => ['required']
        ]);
    }
}
