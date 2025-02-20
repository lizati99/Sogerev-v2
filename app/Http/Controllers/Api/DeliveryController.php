<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use Exception;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $deleveries = Delivery::all();
            if ($deleveries->isEmpty()) {
                return response()->json([
                    'message' => 'Aucune délivrance n\'a été trouvée.',
                    'deleveries' => []
                ], 200);
            }
            return response()->json([
                'message' => 'Liste de toutes les livraisons récupérées avec succès',
                'deleveries' => $deleveries
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la récupération de toutes les livraisons : ' . $exception->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'delivery_date'=>'date',
            'address' => 'string',
            'status'=>'string:max:255',
            'created_by'=>'required|exists:users,id',
            'updated_by'=>'required|exists:users,id',
            'sale_order_id'=>'required|exists:sale_orders,id',
            'order_draft_id'=>'required|exists:order_drafts,id',
            'client_id'=>'required|exists:clients,id',
        ], [
            'delivery_date.date' => 'La date de livraison doit être une date valide.',
            'address.string' => 'L\'addresse doit être une chaîne de caractères.',
            'status.string' => 'Le statut doit être une chaîne de caractères.',
            'created_by.required' => 'La création par est obligatoire.',
            'created_by.exists' => 'La création par doit correspondre à un utilisateur existant.',
            'updated_by.required' => 'La mise à jour par est obligatoire.',
            'updated_by.exists' => 'La mise à jour par doit correspondre à un utilisateur existant.',
            'sale_order_id.required' => 'Le commande de vente est obligatoire.',
            'sale_order_id.exists' => 'La commande de vente doit correspondre à une commande de vente existante.',
            'order_draft_id.required' => 'Le bon de commande est obligatoire.',
            'order_draft_id.exists' => 'Le bon de commande doit correspondre à un bon de commande existant.',
            'client_id.required' => 'Le client est obligatoire.',
            'client_id.exists' => 'Le client doit correspondre à un client existant.'
        ]);
        $delivery = Delivery::create($request->all());
        return response()->json($delivery, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $delivery = Delivery::findOrFail($id);
        return response()->json($delivery, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $delivery = Delivery::findOrFail($id);
        $request->validate([
            'delivery_date'=>'date',
            'address' => 'string',
            'status'=>'string:max:255',
            'created_by'=>'required|exists:users,id',
            'updated_by'=>'required|exists:users,id',
            'sale_order_id'=>'required|exists:sale_orders,id',
            'order_draft_id'=>'required|exists:order_drafts,id',
            'client_id'=>'required|exists:clients,id',
        ], [
            'delivery_date.date' => 'La date de livraison doit être une date valide.',
            'address.string' => 'L\'addresse doit être une chaîne de caractères.',
            'status.string' => 'Le statut doit être une chaîne de caractères.',
            'updated_by.required' => 'La mise à jour par est obligatoire.',
            'updated_by.exists' => 'La mise à jour par doit correspondre à un utilisateur existant.',
            'sale_order_id.required' => 'Le commande de vente est obligatoire.',
            'sale_order_id.exists' => 'La commande de vente doit correspondre à une commande de vente existante.',
            'order_draft_id.required' => 'Le bon de commande est obligatoire.',
            'order_draft_id.exists' => 'Le bon de commande doit correspondre à un bon de commande existant.',
            'client_id.required' => 'Le client est obligatoire.',
            'client_id.exists' => 'Le client doit correspondre à un client existant.'
        ]);
        $delivery->update($request->all());
        return response()->json($delivery, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delivery = Delivery::findOrFail($id);
        $delivery->delete();
        return response()->json(null, 204);
    }
}
