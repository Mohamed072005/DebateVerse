<?php

namespace App\Http\Controllers;

use App\Http\Request\DebateRequest;

use App\Models\Debate;
use App\Models\DebateTag;
use App\Models\Tag;

use App\Repository\DebateRepositoryInterface;
use App\Repository\DebateTagRepositoryInterface;
use App\Repository\TagRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DebateController extends Controller
{
    //
    private $debateTagRepository;
    private $userRepository;
    private $tagRepository;
    private $debateRepository;

    public function __construct(DebateTagRepositoryInterface $debateTagRepository, UserRepositoryInterface $userRepository, TagRepositoryInterface $tagRepository, DebateRepositoryInterface $debateRepository)
    {
        $this->debateTagRepository = $debateTagRepository;
        $this->userRepository = $userRepository;
        $this->tagRepository = $tagRepository;
        $this->debateRepository = $debateRepository;
    }

    public function home()
    {
        $debates = $this->debateTagRepository->getAllDebate();
        $tags = $this->tagRepository->getAllTags();
        $users = $this->userRepository->getUsersWithoutAuthenticatedUser();
        return view('home', compact('debates', 'tags', 'users'));
    }

    public function index()
    {
        return view('admin.dashboard');
    }

    public function store(Request $request)
    {
        $debateRequest = DebateRequest::getInstance();
        $debateRequest->validate($request);

        if ($request->hasFile('img')){
            $imagePath = $request->file('img')->store('uploads', 'public');
        }else{
            $imagePath = null;
        }

        $parametres = $request->all();
        $debate = $this->debateRepository->store($parametres, $imagePath);

        if ($debate && !$request->tag_name == null){
            $debateId = $debate->id;
        }else{
            return redirect()->route('profile')->with('successResponse', 'Your Debate Created Successfully');
        }

        $tags = $request->tag_name;

        $this->debateTagRepository->store($tags, $debateId);

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
            $this->debateTagRepository->destroy($debateTag);
        }
        $tags = $request->tag_name;
        if (!$tags == null){
            $this->debateTagRepository->store($tags, $updatedDebate);
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

    public function findDebateByTag(Tag $tag)
    {
        $tag_id = $tag->id;
        $tags = $this->tagRepository->getAllTags();
        $users = $this->userRepository->getUsersWithoutAuthenticatedUser();
        $debates = $this->debateTagRepository->getByDebateByTag($tag_id);
        return view('tagSearch', compact( 'tags', 'users', 'debates'));
    }

    public function error()
    {
        return view('404');
    }
}
