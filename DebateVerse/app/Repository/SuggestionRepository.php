<?php

namespace App\Repository;

use App\Models\SuggestionsToAdmin;
use App\Repository\SuggestionRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class SuggestionRepository implements SuggestionRepositoryInterface
{

    public function createSuggestion(string $message, int $adminId)
    {
        // TODO: Implement createSuggestion() method.
        SuggestionsToAdmin::create([
            'suggestion' => $message,
            'to_user_id' => $adminId,
            'from_user_id' => Auth::id()
        ]);
    }

    public function getAllSuggestions(){
        $return = SuggestionsToAdmin::where('to_user_id', Auth::id())->get();
        return $return;
    }

    public function getSuggestionById(int $suggestionId)
    {
        // TODO: Implement getSuggestionById() method.
        $return = SuggestionsToAdmin::where('id', $suggestionId)->first();
        return $return;
    }

    public function getAllSuggestionsForSuperAdmin()
    {
        // TODO: Implement getAllSuggestionsForSuperAdmin() method.
        $suggestions = SuggestionsToAdmin::all();
        return $suggestions;
    }

    public function destroySuggestionById(int $suggestionId){
        $suggestion = SuggestionsToAdmin::find($suggestionId);
        $suggestion->delete();
    }
}
