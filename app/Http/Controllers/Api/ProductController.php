<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        try {
            $products = Product::all();
            if ($products->isEmpty()) {
                return response()->json([
                    'message' => 'Aucun produit trouvé',
                    'products' => []
                ], 200);
            }
            return response()->json([
                'message' => 'Liste de tous les produits récupérée avec succès',
                'products' => ProductResource::collection($products)
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la récupération des produits : ' . $exception->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'ref' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'pricePurchase' => 'nullable|numeric',
            'unit_price' => 'nullable|numeric',
            'unit_price_min' => 'nullable|numeric',
            'unit_price_max' => 'nullable|numeric',
            'is_available' => 'nullable|boolean',
            'createdBy' => 'nullable|exists:users,id',
            'subCategory_id' => 'nullable|exists:sub_categories,id'
        ],[
            'name.string' => 'Le nom du produit doit être une chaîne de caractères.',
            'name.max' => 'Le nom du produit ne doit pas dépasser 255 caractères.',
            'ref.string' => 'La référence du produit doit être une chaîne de caractères.',
            'ref.max' => 'La référence du produit ne doit pas dépasser 255 caractères.',
            'description.string' => 'La description du produit doit être une chaîne de caractères.',
            'description.max' => 'La description du produit ne doit pas dépasser 255 caractères.',
            'pricePurchase.numeric' => 'Le prix d\'achat du produit doit être numérique.',
            'unit_price.numeric' => 'Le prix unitaire du produit doit être numérique.',
            'unit_price_min.numeric' => 'Le prix minimum unitaire du produit doit être numérique.',
            'unit_price_max.numeric' => 'Le prix maximum unitaire du produit doit être numérique.',
            'is_available.boolean' => 'La disponibilité du produit doit être une valeur booléenne.',
            'createdBy.exists' => 'L\'utilisateur créateur :attribute n\'existe pas.',
            'subCategory_id.exists' => 'La sous-catégorie :attribute n\'existe pas.'
        ]);
        $product = Product::create($request->all());
        return response()->json($product, 201);
    }

    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return new ProductResource($product);
    }

    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);
        $request->validate([
            'name' => 'nullable|string|max:255',
            'ref' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'pricePurchase' => 'nullable|numeric',
            'unit_price' => 'nullable|numeric',
            'unit_price_min' => 'nullable|numeric',
            'unit_price_max' => 'nullable|numeric',
            'is_available' => 'nullable|boolean',
            'updatedBy' => 'required|exists:users,id',
            'subCategory_id' => 'nullable|exists:sub_categories,id'
        ],[
            'name.string' => 'Le nom du produit doit être une chaîne de caractères.',
            'name.max' => 'Le nom du produit ne doit pas dépasser 255 caractères.',
            'ref.string' => 'La référence du produit doit être une chaîne de caractères.',
            'ref.max' => 'La référence du produit ne doit pas dépasser 255 caractères.',
            'description.string' => 'La description du produit doit être une chaîne de caractères.',
            'description.max' => 'La description du produit ne doit pas dépasser 255 caractères.',
            'pricePurchase.numeric' => 'Le prix d\'achat du produit doit être numérique.',
            'unit_price.numeric' => 'Le prix unitaire du produit doit être numérique.',
            'unit_price_min.numeric' => 'Le prix minimum unitaire du produit doit être numérique.',
            'unit_price_max.numeric' => 'Le prix maximum unitaire du produit doit être numérique.',
            'is_available.boolean' => 'La disponibilité du produit doit être une valeur booléenne.',
            'updatedBy.required' => 'L\'utilisateur modifié est obligatoire.',
            'updatedBy.exists' => 'L\'utilisateur modifié :attribute n\'existe pas.',
            'subCategory_id.exists' => 'La sous-catégorie :attribute n\'existe pas.'
        ]);
        $product->update($request->all());
        return response()->json($product, 200);
    }

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(null, 204);
    }
}
