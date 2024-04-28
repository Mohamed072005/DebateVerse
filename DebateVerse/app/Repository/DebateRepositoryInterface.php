<?php

namespace App\Repository;

interface DebateRepositoryInterface
{
    public function store(Array $debate, ?string $img_path);
    public function getDebatesForStatistics();
}
