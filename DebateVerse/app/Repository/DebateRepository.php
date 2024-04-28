<?php

namespace App\Repository;

use App\Models\Debate;
use App\Repository\DebateRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class DebateRepository implements DebateRepositoryInterface
{
    public function store(array $debate, ?string $img_path)
    {
        // TODO: Implement store() method.
        $debate = Debate::create([
            'content' => $debate['content'],
            'img' => $img_path,
            'user_id' => Auth::id()
        ]);

        return $debate;
    }

    public function getDebatesForStatistics()
    {
        // TODO: Implement getDebatesForStatistics() method.
        $debates = Debate::all();
        return $debates;
    }
}
