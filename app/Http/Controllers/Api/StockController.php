<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Stock;
use Exception;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $stocks = Stock::all();
            if ($stocks->isEmpty()) {
                return response()->json([
                    'message' => 'Aucune stocks trouvé',
                    'stocks' => []
                ], 200);
            }
            return response()->json([
                'message' => 'Liste de tous les stocks récupérée avec succès',
                'stocks' => $stocks
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la récupération de tous les stocks : ' . $exception->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'available_quantity' => 'integer',
            'unit_price' => 'numeric',
            'product_id' => 'required|exists:products,id',
        ], [
            'available_quantity.integer' => 'Le champ : Quantity doit être un nombre entier.',
            'unit_price.numeric' => 'Le champ :prix unitaire doit être un nombre',
            'product_id.exists' => 'Le produit doit correspondre à un produit existant',
            'product_id.required' => 'Le produit est obligatoire',
        ]);
        $stock = Stock::create($request->all());
        return response()->json($stock, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $stock = Stock::findOrFail($id);
        return response()->json($stock, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,string $id)
    {
        $stock = Stock::findOrFail($id);
        $request->validate([
            'available_quantity' => 'integer',
            'unit_price' => 'numeric',
            'product_id' => 'required|exists:products,id',
        ], [
            'available_quantity.integer' => 'Le champ : Quantity doit être un nombre entier.',
            'unit_price.numeric' => 'Le champ :prix unitaire doit être un nombre',
            'product_id.exists' => 'Le produit doit correspondre à un produit existant',
            'product_id.required' => 'Le produit est obligatoire',
        ]);
        $stock->update($request->all());
        return response()->json($stock, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $stock = Stock::findOrFail($id);
        $stock->delete();
        return response()->json(null, 204);
    }
}
