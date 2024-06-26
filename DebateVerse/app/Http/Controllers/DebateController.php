<?php

namespace App\Http\Controllers;

use App\Http\Request\DebateRequest;

use App\Models\Debate;
use App\Models\DebateTag;
use App\Models\Tag;

use App\Repository\DebateRepositoryInterface;
use App\Repository\DebateTagRepositoryInterface;
use App\Repository\MessageRepositoryInterface;
use App\Repository\SuggestionRepositoryInterface;
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
    private $suggestionRepository;
    private $messagesRepository;

    public function __construct(DebateTagRepositoryInterface $debateTagRepository, UserRepositoryInterface $userRepository, TagRepositoryInterface $tagRepository, DebateRepositoryInterface $debateRepository, SuggestionRepositoryInterface $suggestionRepository, MessageRepositoryInterface $messageRepository)
    {
        $this->debateTagRepository = $debateTagRepository;
        $this->userRepository = $userRepository;
        $this->tagRepository = $tagRepository;
        $this->debateRepository = $debateRepository;
        $this->suggestionRepository = $suggestionRepository;
        $this->messagesRepository = $messageRepository;
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
        if (Auth::user()->role_id == 1) {
            $users = $this->userRepository->getUsersForStatistics();
            $debates = $this->debateRepository->getDebatesForStatistics();
            $tags = $this->tagRepository->getAllTags();
            $suggestions = $this->suggestionRepository->getAllSuggestionsForSuperAdmin();
            $messages = $this->messagesRepository->getAllMessagesForStatistics();
            $admins = $this->userRepository->getAdminsForStatistics();
            return view('admin.dashboard', compact('users', 'debates', 'tags', 'suggestions', 'messages', 'admins'));
        }
        return redirect()->route('tags');
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

    public function update(Request $request, Debate $debate)
    {
        $debateRequest = DebateRequest::getInstance();
        $debateRequest->validate($request);
        if ($request->hasFile('img')){
            $imagePath = $request->file('img')->store('uploads', 'public');
        }else{
            $imagePath = null;
        }

        $debate->update([
            'content' => $request->input('content'),
            'img' => $imagePath,
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

    public function report(Request $request, Debate $debate)
    {
        $debateRequest = DebateRequest::getInstance();
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

    public function error403()
    {
        return view('403');
    }

    public function bannedView()
    {
        return view('banned');
    }
}
