<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        try {
            $categories = Category::all();
            if ($categories->isEmpty()) {
                return response()->json([
                    'message' => 'Aucune catégorie trouvée.',
                    'categries' => []
                ], 200);
            }
            return response()->json([
                'message' => 'Liste de toutes les catégories avec succès',
                'categries' => $categories
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la récupération de toutes les catégories : ' . $exception->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'libelle' =>'string|max:255',
        ]);
        $category = Category::create($request->all());
        return response()->json($category, 201);
    }

    public function show(string $id)
    {
        $category = Category::findOrFail($id);
        return $category;
    }

    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);
        $request->validate([
            'libelle' =>'string|max:255',
        ]);
        $category->update($request->all());
        return response()->json($category, 200);
    }

    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return response()->json(null, 204);
    }
}
