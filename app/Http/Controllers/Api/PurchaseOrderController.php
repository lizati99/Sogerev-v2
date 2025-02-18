<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use Exception;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $purchases = PurchaseOrder::all();
            if ($purchases->isEmpty()) {
                return response()->json([
                    'message' => 'Aucune commande d\'achat n\'a été trouvée.',
                    'purchases' => []
                ], 200);
            }
            return response()->json([
                'message' => 'Liste de toutes les commandes d\'achat récupérées avec succès.',
                'purchases' => $purchases
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la récupération de toutes les commandes d\'achat : ' . $exception->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'purchase_date'=>'date',
            'total_amount' =>'numeric',
            'supplier_id'=>'required|exists:suppliers,id',
            'payment_type_id'=>'required|exists:payment_types,id',
        ], [
            'purchase_date.date' => 'La date d\'achat doit être une date valide.',
            'total_amount.numeric' => 'Le champ : Montant total doit être un nombre.',
            'supplier_id.exists' => 'Le fournisseur doit correspondre à un fournisseur existant',
            'supplier_id.required' => 'Le fournisseur est obligatoire',
            'payment_type_id.exists' => 'Le type de paiement doit correspondre à un type existant',
            'payment_type_id.required' => 'Le type de paiement est obligatoire',
        ]);
        $purchase = PurchaseOrder::create($request->all());
        return response()->json($purchase, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(PurchaseOrder $purchase)
    {
        $purchase = PurchaseOrder::findOrFail($purchase);
        return response()->json($purchase, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PurchaseOrder $purchase)
    {
        $purchase = PurchaseOrder::findOrFail($purchase);
        $request->validate([
            'purchase_date'=>'date',
            'total_amount' =>'numeric',
            'supplier_id'=>'required|exists:suppliers,id',
            'payment_type_id'=>'required|exists:payment_types,id',
        ], [
            'purchase_date.date' => 'La date d\'achat doit être une date valide.',
            'total_amount.numeric' => 'Le champ : Montant total doit être un nombre.',
            'supplier_id.exists' => 'Le fournisseur doit correspondre à un fournisseur existant',
            'supplier_id.required' => 'Le fournisseur est obligatoire',
            'payment_type_id.exists' => 'Le type de paiement doit correspondre à un type existant',
            'payment_type_id.required' => 'Le type de paiement est obligatoire',
        ]);
        $purchase->update($request->all());
        return response()->json($purchase, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PurchaseOrder $purchase)
    {
        $purchase = PurchaseOrder::findOrFail($purchase);
        $purchase->delete();
        return response()->json(null, 204);
    }
}
