<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Devi;
use Exception;
use Illuminate\Http\Request;

class DeviController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $devis = Devi::all();
            if ($devis->isEmpty()) {
                return response()->json([
                    'message' => 'Aucun devis trouvé.',
                    'devis' => []
                ], 200);
            }
            return response()->json([
                'message' => 'Liste de tous les devis récupérés avec succès',
                'devis' => $devis
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la récupération de toutes les devises : ' . $exception->getMessage()
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
            'total_HT'=>'numeric',
            'total_TVA'=>'numeric',
            'total_TTC'=>'numeric',
            'TVA_rate'=>'numeric',
            'devi_date'=>'date',
            'created_by'=>'required|exists:users,id',
            'updated_by'=>'required|exists:users,id',
            'client_id'=>'required|exists:clients,id',
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
            'client_id.exists' => 'Le client du devis doit correspondre à un client existant.'
        ]);
        $devi = Devi::create($request->all());
        return response()->json($devi, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $devi = Devi::findOrFail($id);
        return response()->json($devi, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $devi = Devi::findOrFail($id);
        $request->validate([
            'numero' => 'string',
            'title'=>'string',
            'total_HT'=>'numeric',
            'total_TVA'=>'numeric',
            'total_TTC'=>'numeric',
            'TVA_rate'=>'numeric',
            'devi_date'=>'date',
            'updated_by'=>'required|exists:users,id',
            'client_id'=>'required|exists:clients,id',
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
            'client_id.exists' => 'Le client du devis doit correspondre à un client existant.'
        ]);
        $devi->update($request->all());
        return response()->json($devi, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $devi = Devi::findOrFail($id);
        $devi->delete();
        return response()->json(null, 204);
    }
}
