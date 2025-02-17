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
            'name' => ['string','max:255'],
            'description' => ['string','max:255'],
            'unit_price' => ['numeric'],
            'quantity' => ['integer'],
        ]);
        $product = Product::create($request->all());
        return response()->json($product, 201);
    }

    public function show(Product $product)
    {
        $product = Product::findOrFail($product);
        return new ProductResource($product);
    }

    public function update(Request $request, Product $product)
    {
        $product = Product::findOrFail($product);
        $product->update($request->all());
        return response()->json($product, 200);
    }

    public function destroy(Product $product)
    {
        $product = Product::findOrFail($product);
        $product->delete();
        return response()->json(null, 204);
    }
}
