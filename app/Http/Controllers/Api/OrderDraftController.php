<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OrderDraft;
use Exception;
use Illuminate\Http\Request;

class OrderDraftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $drafts = OrderDraft::all();
            if ($drafts->isEmpty()) {
                return response()->json([
                    'message' => 'Aucun bon de commande n\'a été trouvé.',
                    'drafts' => []
                ], 200);
            }
            return response()->json([
                'message' => 'Liste de tous les bons de commande récupérés avec succès',
                'drafts' => $drafts
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la récupération de tous les bons de commande : ' . $exception->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'numero' => 'string',
            'title'=>'string',
            'sujet' => 'string',
            'total_HT'=>'numeric',
            'total_TVA'=>'numeric',
            'total_TTC'=>'numeric',
            'TVA_rate'=>'numeric',
            'orderDraft_date'=>'date',
            'status'=>'string:max:255',
            'created_by'=>'required|exists:users,id',
            'updated_by'=>'required|exists:users,id',
            'client_id'=>'required|exists:clients,id',
            'devi_id'=>'required|exists:devis,id'
        ], [
            'numero.string' => 'Le numéro du devis doit être une chaîne de caractères.',
            'title.string' => 'Le titre du devis doit être une chaîne de caractères.',
            'total_HT.numeric' => 'Le total HT du devis doit être un nombre.',
            'total_TVA.numeric' => 'Le total TVA du devis doit être un nombre.',
            'total_TTC.numeric' => 'Le total TTC du devis doit être un nombre.',
            'TVA_rate.numeric' => 'Le taux de TVA du devis doit être un nombre.',
            'devi_date.date' => 'La date du devis doit être une date valide.',
            'created_by.required' => 'Le créateur du devis est obligatoire.',
            'created_by.exists' => 'Le créateur du devis doit correspondre à un utilisateur existant.',
            'updated_by.required' => 'Le mise à jour du devis est obligatoire.',
            'updated_by.exists' => 'Le mise à jour du devis doit correspondre à un utilisateur existant.',
            'client_id.required' => 'Le client du devis est obligatoire.',
            'client_id.exists' => 'Le client du devis doit correspondre à un client existant.',
            'devi_id.required' => 'Le devis est obligatoire pour constituer le dossier de bon de commande.',
            'devi_id.exists' => 'Le devi du bon de commande doit correspondre à un bon de commande existant.'
        ]);
        $draft = OrderDraft::create($request->all());
        return response()->json($draft, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderDraft $orderDraft)
    {
        $draft = OrderDraft::findOrFail($orderDraft);
        return response()->json($draft, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OrderDraft $orderDraft)
    {
        $draft = OrderDraft::findOrFail($orderDraft);
        $request->validate([
            'numero' => 'string',
            'title'=>'string',
            'sujet' => 'string',
            'total_HT'=>'numeric',
            'total_TVA'=>'numeric',
            'total_TTC'=>'numeric',
            'TVA_rate'=>'numeric',
            'orderDraft_date'=>'date',
            'status'=>'string:max:255',
            'updated_by'=>'required|exists:users,id',
            'client_id'=>'required|exists:clients,id',
            'devi_id'=>'required|exists:devis,id'
        ], [
            'numero.string' => 'Le numéro du devis doit être une chaîne de caractères.',
            'title.string' => 'Le titre du devis doit être une chaîne de caractères.',
            'total_HT.numeric' => 'Le total HT du devis doit être un nombre.',
            'total_TVA.numeric' => 'Le total TVA du devis doit être un nombre.',
            'total_TTC.numeric' => 'Le total TTC du devis doit être un nombre.',
            'TVA_rate.numeric' => 'Le taux de TVA du devis doit être un nombre.',
            'devi_date.date' => 'La date du devis doit être une date valide.',
            'updated_by.required' => 'Le mise à jour du devis est obligatoire.',
            'updated_by.exists' => 'Le mise à jour du devis doit correspondre à un utilisateur existant.',
            'client_id.required' => 'Le client du devis est obligatoire.',
            'client_id.exists' => 'Le client du devis doit correspondre à un client existant.',
            'devi_id.required' => 'Le devis est obligatoire pour constituer le dossier de bon de commande.',
            'devi_id.exists' => 'Le devi du bon de commande doit correspondre à un bon de commande existant.'
        ]);
        $draft->update($request->all());
        return response()->json($draft, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderDraft $orderDraft)
    {
        $draft = OrderDraft::findOrFail($orderDraft);
        $draft->delete();
        return response()->json(null, 204);
    }
}
