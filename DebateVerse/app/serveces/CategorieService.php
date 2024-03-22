<?php

namespace App\serveces;

use App\Models\Categorie;
use App\serveces\CategorieServiceInterface;

class CategorieService implements CategorieServiceInterface
{

    public function store(Array $categorie)
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
        // TODO: Implement upodat() method.
        $categorie->update([
            'categorie_name' => $categorie->categorie_name
        ]);
    }
}
