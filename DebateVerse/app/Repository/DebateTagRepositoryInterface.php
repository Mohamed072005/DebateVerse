<?php

namespace App\Repository;

use App\Models\Debate;
use Illuminate\Support\Collection;

interface DebateTagRepositoryInterface
{
    public function store(Array $tags, int $debate);
    public function destroy(Collection $debateTag);
    public function getByDebateByTag(int $tag);
    public function getAllDebate();
}
