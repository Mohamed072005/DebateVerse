<?php

namespace App\Repository;

use App\Models\Categorie;
use App\Repository\CategorieRepositoryInterface;

class CategorieRepository implements CategorieRepositoryInterface
{

    public function store(array $categorie)
    {
        // TODO: Implement store() method.
        Categorie::create($categorie);
    }

    public function destroy(Categorie $categorie)
    {
        // TODO: Implement destroy() method.
        $categorie->delete();
    }

    public function update(Categorie $categorie)
    {
        // TODO: Implement update() method.
        $categorie->update([
            'categorie_name' => $categorie->categorie_name
        ]);
    }
}
