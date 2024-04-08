<?php

namespace App\serveces;

use App\Models\Debate;
use App\Models\DebateTag;
use Illuminate\Support\Collection;

interface DebateTagServiceInterface
{
    public function store(Array $tags, int $debate);
    public function destroy(Collection $debateTag);
}
