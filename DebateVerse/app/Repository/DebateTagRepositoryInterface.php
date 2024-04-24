<?php

namespace App\Repository;

use Illuminate\Support\Collection;

interface DebateTagRepositoryInterface
{
    public function store(Array $tags, int $debate);
    public function destroy(Collection $debateTag);
}
