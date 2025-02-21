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
                    'success' => true,
                    'message' => 'Aucune catégorie trouvée.',
                    'data' => []
                ], 200);
            }

            return response()->json([
                'success' => true,
                'message' => 'Liste de toutes les catégories récupérées avec succès.',
                'data' => $categories
            ], 200);

        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la récupération des catégories : ' . $exception->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'libelle' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'subcategories' => 'nullable|array',
                'subcategories.*.libelle' => 'nullable|string|max:255',
                'subcategories.*.description' => 'nullable|string',
            ], [
                'libelle.string' => 'Le libelle doit être une chaîne de caractères.',
                'libelle.max' => 'Le libelle ne doit pas dépasser 255 caractères.',
                'description.string' => 'La description doit être une chaîne de caractères.',
                'subcategories.*.libelle.string' => 'Le libelle de la sous-catégorie doit être une chaîne de caractères..',
                'subcategories.*.libelle.max' => 'Le libelle de la sous-catégorie ne doit pas dépasser 255 caractères.',
            ]);

            $category = Category::create([
                'libelle' => $validatedData['libelle'] ?? null,
                'description' => $validatedData['description'] ?? null,
            ]);

            if (isset($validatedData['subcategories']) && is_array($validatedData['subcategories'])) {
                foreach ($validatedData['subcategories'] as $subCategoryData) {
                    $category->subCategories()->create([
                        'libelle' => $subCategoryData['libelle'] ?? null,
                        'description' => $subCategoryData['description'] ?? null,
                    ]);
                }
            }else {
                $category->subcategories()->create([
                    'libelle' => $validatedData['libelle'] ?? null,
                    'description' => $validatedData['description'] ?? null,
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Catégorie et ses sous-catégories créées avec succès.',
                'data' => $category
            ], 201);

        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la création de la catégorie : ' . $exception->getMessage()
            ], 500);
        }
    }

    public function show(string $id)
    {
        try {
            $category = Category::with('sub_categories')->findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'Détails de la catégorie récupérés avec succès.',
                'data' => $category
            ], 200);

        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la récupération des détails de la catégorie : ' . $exception->getMessage()
            ], 404);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $category = Category::findOrFail($id);

            $validatedData = $request->validate([
                'libelle' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'subcategories' => 'nullable|array',
                'subcategories.*.id' => 'required|exists:sub_categories,id',
                'subcategories.*.libelle' => 'nullable|string|max:255',
                'subcategories.*.description' => 'nullable|string',
            ], [
                'libelle.string' => 'Le libelle doit être une chaîne de caractères.',
                'libelle.max' => 'Le libelle ne doit pas dépasser 255 caractères.',
                'description.string' => 'La description doit être une chaîne de caractères.',
                'subcategories.*.id.required' => 'ID de la sous-catégorie est obligatoire.',
                'subcategories.*.id.exists' => 'ID de la sous-catégorie n’existe pas dans la base de données.',
                'subcategories.*.libelle.string' => 'Le libelle de la sous-catégorie doit être une chaîne de caractères..',
                'subcategories.*.libelle.max' => 'Le libelle de la sous-catégorie ne doit pas dépasser 255 caractères.',
            ]);

            $category->update([
                'libelle' => $validatedData['libelle'] ?? $category->libelle,
                'description' => $validatedData['description'] ?? $category->description,
            ]);

            if (isset($validatedData['subcategories']) && is_array($validatedData['subcategories'])) {
                foreach ($validatedData['subcategories'] as $subCategoryData) {
                    $subCategory = $category->subCategories()->where('id', $subCategoryData['id'])->first();

                    if ($subCategory) {
                        $subCategory->update([
                            'libelle' => $subCategoryData['libelle'] ?? $subCategory->libelle,
                            'description' => $subCategoryData['description'] ?? $subCategory->description,
                        ]);
                    }
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Catégorie et ses sous-catégories mises à jour avec succès.',
                'data' => $category
            ], 200);

        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la mise à jour de la catégorie : ' . $exception->getMessage()
            ], 500);
        }
    }

    public function destroy(string $id)
    {
        try {
            $category = Category::findOrFail($id);

            $category->delete();

            return response()->json([
                'success' => true,
                'message' => 'Catégorie supprimée avec succès.',
                'data' => null
            ], 204);

        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la suppression de la catégorie : ' . $exception->getMessage()
            ], 500);
        }
    }
}
