<?php

namespace App\Repository;

use App\Models\Tag;
use App\Repository\TagRepositoryInterface;

class TagRepository implements TagRepositoryInterface
{

    public function getAllTags()
    {
        // TODO: Implement getAllTags() method.
        return Tag::all();
    }
}
