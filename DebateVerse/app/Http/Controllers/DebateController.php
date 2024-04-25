<?php

namespace App\Http\Controllers;

use App\Http\Request\DebateRequest;
use App\Models\Categorie;
use App\Models\Debate;
use App\Models\DebateTag;
use App\Models\Tag;
use App\Repository\CategorieRepositoryInterface;
use App\Repository\DebateTagRepositoryInterface;
use App\Repository\TagRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DebateController extends Controller
{
    //
    private $debateRepository;
    private $userRepository;
    private $categorieRepository;
    private $tagRepository;

    public function __construct(DebateTagRepositoryInterface $debateRepository, UserRepositoryInterface $userRepository, CategorieRepositoryInterface $categorieRepository, TagRepositoryInterface $tagRepository)
    {
        $this->debateRepository = $debateRepository;
        $this->userRepository = $userRepository;
        $this->categorieRepository = $categorieRepository;
        $this->tagRepository = $tagRepository;
    }

    public function home()
    {
        $debates = $this->debateRepository->getAllDebate();
        $categories = $this->categorieRepository->getAllCategories();
        $tags = $this->tagRepository->getAllTags();
        $users = $this->userRepository->getUsersWithoutAuthenticatedUser();
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

        $this->debateRepository->store($tags, $debateId);

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
            $this->debateRepository->destroy($debateTag);
        }
        $tags = $request->tag_name;
        if (!$tags == null){
            $this->debateRepository->store($tags, $updatedDebate);
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

    public function findDebate(Tag $tag)
    {
        $tag_id = $tag->id;
        $categories = $this->categorieRepository->getAllCategories();
        $tags = $this->tagRepository->getAllTags();
        $users = $this->userRepository->getUsersWithoutAuthenticatedUser();
        $debates = $this->debateRepository->getByDebateByTag($tag_id);
        return view('tagSearch', compact( 'categories', 'tags', 'users', 'debates'));
    }

    public function error()
    {
        return view('404');
    }
}
