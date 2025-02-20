<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SaleOrder;
use Exception;
use Illuminate\Http\Request;

class SaleOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $sales = SaleOrder::all();
            if ($sales->isEmpty()) {
                return response()->json([
                    'message' => 'Aucune commande de vante n\'a été trouvée.',
                    'sales' => []
                ], 200);
            }
            return response()->json([
                'message' => 'Liste de toutes les commandes vente récupérées avec succès.',
                'sales' => $sales
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la récupération de toutes les commandes de vente : ' . $exception->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'sale_date'=>'date',
            'total_amount' =>'numeric',
            'client_id'=>'required|exists:clients,id',
            'payment_type_id'=>'required|exists:payment_types,id',
        ], [
            'sale_date.date' => 'La date d\'achat doit être une date valide.',
            'total_amount.numeric' => 'Le champ : Montant total doit être un nombre.',
            'client_id.exists' => 'Le client doit correspondre à un client existant',
            'client_id.required' => 'Le client est obligatoire',
            'payment_type_id.exists' => 'Le type de paiement doit correspondre à un type existant',
            'payment_type_id.required' => 'Le type de paiement est obligatoire',
        ]);
        $sale = SaleOrder::create($request->all());
        return response()->json($sale, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sale = SaleOrder::findOrFail($id);
        return response()->json($sale, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $sale = SaleOrder::findOrFail($id);
        $request->validate([
            'sale_date'=>'date',
            'total_amount' =>'numeric',
            'client_id'=>'required|exists:clients,id',
            'payment_type_id'=>'required|exists:payment_types,id',
        ], [
            'sale_date.date' => 'La date d\'achat doit être une date valide.',
            'total_amount.numeric' => 'Le champ : Montant total doit être un nombre.',
            'client_id.exists' => 'Le client doit correspondre à un client existant',
            'client_id.required' => 'Le client est obligatoire',
            'payment_type_id.exists' => 'Le type de paiement doit correspondre à un type existant',
            'payment_type_id.required' => 'Le type de paiement est obligatoire',
        ]);
        $sale->update($request->all());
        return response()->json($sale, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sale = SaleOrder::findOrFail($id);
        $sale->delete();
        return response()->json(null, 204);
    }
}
