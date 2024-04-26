<?php

namespace App\Repository;

use App\Models\suggestionsToAdmin;
use App\Repository\SuggestionRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class SuggestionRepository implements SuggestionRepositoryInterface
{

    public function createSuggestion(string $message, int $adminId)
    {
        // TODO: Implement createSuggestion() method.
        suggestionsToAdmin::create([
            'suggestion' => $message,
            'to_user_id' => $adminId,
            'from_user_id' => Auth::id()
        ]);
    }
}
