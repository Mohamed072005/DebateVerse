<?php

namespace App\Repository;

interface SuggestionRepositoryInterface
{
    public function createSuggestion(string $message, int $adminId);
}
