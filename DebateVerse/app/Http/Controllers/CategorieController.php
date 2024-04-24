<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Repository\CategorieRepositoryInterface;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    protected $categorieRepository;

    public function __construct(CategorieRepositoryInterface $categorieRepository)
    {
        $this->categorieRepository = $categorieRepository;
    }

    //
    public function index()
    {
        return view('admin.dashboard');
    }

    public function toCategories()
    {
        $categories = Categorie::all();
        return view('admin.categories', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'categorie_name' => ['required', 'unique:categories']
        ]);

        $this->categorieRepository->store($validated);

        return redirect()->route('categories')->with('addSuccess', 'Your Categorie Created Successfully');
    }

    public function destroy(Categorie $categorie)
    {
        $this->categorieRepository->destroy($categorie);

        return redirect()->route('categories')->with('addSuccess', 'Your Categorie Deleted Successfully');
    }

    public function update(Request $request, Categorie $categorie)
    {
        $request->validate([
            'categorie_name' => ['required', 'unique:categories']
        ]);

        $categorie->categorie_name = $request->categorie_name;

        $this->categorieRepository->update($categorie);

        return redirect()->route('categories')->with('addSuccess', 'Your Categorie Updated Successfully');
    }
}
