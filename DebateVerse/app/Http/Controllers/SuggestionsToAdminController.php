<?php

namespace App\Http\Controllers;

use App\Http\Request\SuggestionRequest;
use App\Models\SuggestionsToAdmin;
use App\Repository\SuggestionRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use App\serveces\SuggestionService;
use App\serveces\SuggestionServiceInterface;
use Illuminate\Http\Request;

class SuggestionsToAdminController extends Controller
{
    //
    private $userRepository;
    private $suggestionService;
    private $suggestionRepository;
    public function __construct(UserRepositoryInterface $userRepository, SuggestionServiceInterface $suggestionService, SuggestionRepositoryInterface $suggestionRepository)
    {
        $this->userRepository = $userRepository;
        $this->suggestionService = $suggestionService;
        $this->suggestionRepository = $suggestionRepository;
    }

    public function index()
    {
        return view('admin.suggestions', ['suggestions' => $this->suggestionRepository->getAllSuggestionsForSuperAdmin()]);
    }

    public function toSendSuggestions()
    {
        return view('suggestion');
    }

    public function sendSuggestion(Request $request){
        $validate = SuggestionRequest::getInstance();
        $validate->validateRequest($request);
        $admins = $this->userRepository->getAdminId();
        $adminId = $this->suggestionService->getAdminsIdByRandom($admins);
        $message = $request->message;
        $this->suggestionRepository->createSuggestion($message, $adminId);
        return redirect()->route('home')->with('successResponse', 'Suggestion sent!');
    }

    public function suggestion(SuggestionsToAdmin $suggestionsToAdmin)
    {
        $suggestionId = $suggestionsToAdmin->id;
        $suggestion = $this->suggestionRepository->getSuggestionById($suggestionId);
        return view('suggestionDetails', compact('suggestion'));
    }

    public function destroy($suggestionId)
    {
        $this->suggestionRepository->destroySuggestionById($suggestionId);
        return redirect()->route('admin.suggestions')->with('successResponse', 'Suggestion deleted!');
    }
}
