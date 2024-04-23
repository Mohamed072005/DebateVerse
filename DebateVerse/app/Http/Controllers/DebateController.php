<?php

namespace App\Http\Controllers;

use App\Http\Request\DebateRequest;
use App\Models\Categorie;
use App\Models\Debate;
use App\Models\DebateTag;
use App\Models\Tag;
use App\Models\User;
use App\serveces\DebateTagService;
use App\serveces\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DebateController extends Controller
{
    //
    private $debateServices;
    private $userServices;

    public function __construct(DebateTagService $debateServices)
    {
        $this->debateServices = $debateServices;
        $this->userServices = UserService::getInstance();
    }

    public function home()
    {
        $debates = Debate::all();
        $categories = Categorie::all();
        $tags = Tag::all();
        $users = $this->userServices->getUsersWithoutAuthenticatedUser();
        return view('home', compact('debates', 'categories', 'tags', 'users'));
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

        $tags = $request->tag_name;

        $this->debateServices->store($tags, $debateId);

//        foreach ($tags as $tag) {
//            DebateTag::create([
//                'debate_id' => $debateId,
//                'tag_id' => $tag
//            ]);
//        }

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

    public function update(Request $request, DebateRequest $debateRequest, Debate $debate)
    {
        $debateRequest->validate($request);
        if ($request->hasFile('img')){
            $imagePath = $request->file('img')->store('uploads', 'public');
        }else{
            $imagePath = null;
        }

        $debate->update([
            'content' => $request->input('content'),
            'img' => $imagePath,
            'categorie_id' => $request->input('categorie_name')
        ]);

        $updatedDebate = $debate->id;

        $debateTag = DebateTag::where('debate_id', $updatedDebate)->get();
        if ($debateTag){
            $this->debateServices->destroy($debateTag);
        }
        $tags = $request->tag_name;
        if (!$tags == null){
            $this->debateServices->store($tags, $updatedDebate);
        }

        if ($request->token){
            return redirect()->route('profile')->with('successResponse', 'Your Debate Updated Successfully');
        }else{
            return redirect()->route('home')->with('successResponse', 'Your Debate Updated Successfully');
        }
    }

    public function report(Request $request, Debate $debate, DebateRequest $debateRequest)
    {
        $debateRequest->validateReport($request);

        $debateReport = $debate->reports;

        $debate->reports = $debateReport + 1;
        $debate->save();

        if ($debate->reports == 10){
            $debate->status = 0;
            $debate->save();
        }

        if ($request->token){
            return redirect()->route('users.profile', $debate->user_id)->with('successResponse', 'Your Report send Successfully, and we will Check it');
        }else{
            return redirect()->route('home')->with('successResponse', 'Your Report send Successfully, and we will Check it');
        }
    }

    public function error()
    {
        return view('404');
    }
}
