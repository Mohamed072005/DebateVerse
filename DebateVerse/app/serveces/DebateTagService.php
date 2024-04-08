<?php

namespace App\serveces;

use App\Models\Debate;
use App\Models\DebateTag;
use App\serveces\DebateTagServiceInterface;
use Illuminate\Support\Collection;

class DebateTagService implements DebateTagServiceInterface
{

    public function store(array $tags, int $debate)
    {
        // TODO: Implement store() method.
        foreach ($tags as $tag){
            DebateTag::create([
                'debate_id' => $debate,
                'tag_id' => $tag
            ]);
        }
    }

    public function destroy(Collection $debateTag)
    {
        // TODO: Implement destroy() method.
        foreach ($debateTag as $deleted){
            $deleted->delete();
        }
    }
}
