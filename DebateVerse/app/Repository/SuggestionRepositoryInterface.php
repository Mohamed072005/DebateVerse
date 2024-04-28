<?php

namespace App\Repository;

use App\Models\SuggestionsToAdmin;

interface SuggestionRepositoryInterface
{
    public function createSuggestion(string $message, int $adminId);
    public function getAllSuggestions();
    public function getSuggestionById(int $suggestionId);
    public function getAllSuggestionsForSuperAdmin();
    public function destroySuggestionById(int $suggestionId);
}
