<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\serveces\CategorieService;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    protected $categorieService;

    public function __construct(CategorieService $categorieService)
    {
        $this->categorieService = $categorieService;
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

        $this->categorieService->store($validated);

        return redirect()->route('categories')->with('addSuccess', 'Your Categorie Created Successfully');
    }

    public function destroy(Categorie $categorie)
    {
        $this->categorieService->destroy($categorie);

        return redirect()->route('categories')->with('addSuccess', 'Your Categorie Deleted Successfully');
    }

    public function update(Request $request, Categorie $categorie)
    {
        $request->validate([
            'categorie_name' => ['required', 'unique:categories']
        ]);

        $categorie->categorie_name = $request->categorie_name;

        $this->categorieService->update($categorie);

        return redirect()->route('categories')->with('addSuccess', 'Your Categorie Updated Successfully');
    }
}
