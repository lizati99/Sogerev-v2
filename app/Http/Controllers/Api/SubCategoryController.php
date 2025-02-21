<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use Exception;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $subCategories = SubCategory::all();

            if ($subCategories->isEmpty()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Aucune sous-catégorie trouvée.',
                    'data' => []
                ], 200);
            }

            return response()->json([
                'success' => true,
                'message' => 'Liste de toutes les sous-catégories récupérées avec succès.',
                'data' => $subCategories
            ], 200);

        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la récupération des sous-catégories : ' . $exception->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'libelle' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'category_id' => 'required|exists:categories,id',
            ], [
                'libelle.string' => 'Le libelle doit être une chaîne de caractères.',
                'libelle.max' => 'Le libelle ne doit pas dépasser 255 caractères.',
                'description.string' => 'La description doit être une chaîne de caractères.',
                'category_id.required' => 'L’ID de la catégorie est obligatoire.',
                'category_id.exists' => 'La catégorie avec cet ID n’existe pas.',
            ]);

            $subCategory = SubCategory::create($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Sous-catégorie créée avec succès.',
                'data' => $subCategory
            ], 201);

        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la création de la sous-catégorie : ' . $exception->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $subCategory = SubCategory::findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'Détails de la sous-catégorie récupérés avec succès.',
                'data' => $subCategory
            ], 200);

        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la récupération des détails de la sous-catégorie : ' . $exception->getMessage()
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $subCategory = SubCategory::findOrFail($id);

            $validatedData = $request->validate([
                'libelle' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'category_id' => 'required|exists:categories,id',
            ], [
                'libelle.string' => 'Le libelle doit être une chaîne de caractères.',
                'libelle.max' => 'Le libelle ne doit pas dépasser 255 caractères.',
                'description.string' => 'La description doit être une chaîne de caractères.',
                'category_id.required' => 'L’ID de la catégorie est obligatoire.',
                'category_id.exists' => 'La catégorie est obligatoire.',
            ]);

            $subCategory->update($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Sous-catégorie mise à jour avec succès.',
                'data' => $subCategory
            ], 200);

        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la mise à jour de la sous-catégorie : ' . $exception->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $subCategory = SubCategory::findOrFail($id);

            $subCategory->delete();

            return response()->json([
                'success' => true,
                'message' => 'Sous-catégorie supprimée avec succès.',
                'data' => null
            ], 204);

        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la suppression de la sous-catégorie : ' . $exception->getMessage()
            ], 500);
        }
    }
}
