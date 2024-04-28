<?php

namespace App\Repository;

use App\Models\Debate;
use App\Models\DebateTag;
use App\Repository\DebateTagRepositoryInterface;
use Illuminate\Support\Collection;

class DebateTagRepository implements DebateTagRepositoryInterface
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

    public function getByDebateByTag(int $tag)
    {
        // TODO: Implement getByDebateByTag() method.
        $debates = DebateTag::where('tag_id', $tag)
            ->get();
        return $debates;
    }

    public function getAllDebate()
    {
        // TODO: Implement getAllDebate() method.
        $debates = Debate::all();
        return $debates;
    }
}
