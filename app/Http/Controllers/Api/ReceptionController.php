<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reception;
use Exception;
use Illuminate\Http\Request;

class ReceptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $receptions = Reception::all();
            if ($receptions->isEmpty()) {
                return response()->json([
                    'message' => 'Aucune réception trouvée.',
                    'receptions' => []
                ], 200);
            }
            return response()->json([
                'message' => 'Liste de toutes les réceptions récupérée avec succès',
                'receptions' => $receptions
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la récupération de toutes les réceptions : ' . $exception->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'reception_date'=>'date',
            'supplier_id'=>'required|exists:suppliers,id',
            'purchase_order_id'=>'required|exists:purchase_orders,id',
            'cash_register_id'=>'required|exists:cash_registers,id',
        ], [
            'reception_date.date' => 'La date d\'achat doit être une date valide.',
            'total_amount.numeric' => 'Le champ : Montant total doit être un nombre.',
            'supplier_id.exists' => 'Le fournisseur doit correspondre à un fournisseur existant',
            'supplier_id.required' => 'Le fournisseur est obligatoire',
            'purchase_order_id.exists' => 'La commande d\'achat doit correspondre à une commande existante',
            'purchase_order_id.required' => 'La commande d\'achat est obligatoire',
            'cash_register_id.exists' => 'Le registre de caisse doit correspondre à un registre existant',
            'cash_register_id.required' => 'Le registre de caisse est obligatoire',
        ]);
        $reception = Reception::create($request->all());
        return response()->json($reception, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Reception $reception)
    {
        $reception = Reception::findOrFail($reception);
        return response()->json($reception, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reception $reception)
    {
        $reception = Reception::findOrFail($reception);
        $request->validate([
            'reception_date'=>'date',
            'supplier_id'=>'required|exists:suppliers,id',
            'purchase_order_id'=>'required|exists:purchase_orders,id',
            'cash_register_id'=>'required|exists:cash_registers,id',
        ], [
            'reception_date.date' => 'La date d\'achat doit être une date valide.',
            'total_amount.numeric' => 'Le champ : Montant total doit être un nombre.',
            'supplier_id.exists' => 'Le fournisseur doit correspondre à un fournisseur existant',
            'supplier_id.required' => 'Le fournisseur est obligatoire',
            'purchase_order_id.exists' => 'La commande d\'achat doit correspondre à une commande existante',
            'purchase_order_id.required' => 'La commande d\'achat est obligatoire',
            'cash_register_id.exists' => 'Le registre de caisse doit correspondre à un registre existant',
            'cash_register_id.required' => 'Le registre de caisse est obligatoire',
        ]);
        $reception->update($request->all());
        return response()->json($reception, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reception $reception)
    {
        $reception = Reception::findOrFail($reception);
        $reception->delete();
        return response()->json(null, 204);
    }
}
