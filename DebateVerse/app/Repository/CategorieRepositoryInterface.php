<?php

namespace App\Repository;

use App\Models\Categorie;

interface CategorieRepositoryInterface
{
    public function store(Array $categorie);
    public function destroy(Categorie $categorie);
    public function update(Categorie $categorie);
    public function getAllCategories();
}
