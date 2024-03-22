<?php

namespace App\serveces;

use App\Models\Categorie;

interface CategorieServiceInterface
{
    public function store(Array $categorie);
    public function destroy(Categorie $categorie);
    public function update(Categorie $categorie);
}
