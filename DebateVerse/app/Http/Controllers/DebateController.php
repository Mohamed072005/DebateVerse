<?php

namespace App\Http\Controllers;

use App\Http\Request\DebateRequest;
use App\Models\Debate;
use App\Models\DebateTag;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DebateController extends Controller
{
    //
    public function home()
    {
        $debates = Debate::all();
        return view('home', compact('debates'));
    }

    public function store(DebateRequest $debateRequest, Request $request)
    {
        $debateRequest->validate($request);

        if ($request->hasFile('img')){
            $imagePath = $request->file('img')->store('uploads', 'public');
        }else{
            $imagePath = null;
        }

        $debate = Debate::create([
            'content' => $request->input('content'),
            'img' => $imagePath,
            'categorie_id' => $request->input('categorie_name'),
            'user_id' => Auth::id()
        ]);

        if ($debate && !$request->tag_name == null){
            $debateId = $debate->id;
        }else{
            return redirect()->route('profile')->with('successResponse', 'Your Debate Created Successfully');
        }

        foreach ($request->tag_name as $tag) {
            DebateTag::create([
                'debate_id' => $debateId,
                'tag_id' => $tag
            ]);
        }

        return redirect()->route('profile')->with('successResponse', 'Your Debate Created Successfully');
    }

    public function destroy(Debate $debate, Request $request)
    {
        if ($request->token){
            $debate->delete();
            return redirect()->route('profile')->with('successResponse', 'Your Debate Deleted Successfully');
        }else{
            $debate->delete();
            return redirect()->route('home')->with('successResponse', 'Your Debate Deleted Successfully');
        }

    }
}
