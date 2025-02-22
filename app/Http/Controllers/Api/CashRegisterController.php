<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CashRegister;
use Exception;
use Illuminate\Http\Request;

class CashRegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $chashRegisters = CashRegister::all();
            if ($chashRegisters->isEmpty()) {
                return response()->json([
                    'message' => 'Aucune caisse n\'a été trouvée.',
                    'cashRegisters' => []
                ], 200);
            }
            return response()->json([
                'message' => 'Liste de toutes les caisses récupérées avec succès.',
                'cashRegisters' => $chashRegisters
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la récupération de toutes les caisses : ' . $exception->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'actual_balance'=>'numeric',
            'status' =>'string|max:255',
            'operation_type'=>'boolean',
            'amount'=>'numeric',
        ], [
            'actual_balance.numeric' => 'Le solde doit être un nombre.',
            'status.string' => 'Le statut doit être une chaîne de caractères.',
            'status.max' => 'Le statut ne doit pas dépasser 255 caractères',
            'operation_type.boolean' => 'Le type d\'opération doit être un booléen.',
            'amount.numeric' => 'Le montant doit être un nombre.',
        ]);
        $cashRegister = CashRegister::create($request->all());
        return response()->json($cashRegister, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cashRegister = CashRegister::findOrFail($id);
        return response()->json($cashRegister, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cashRegister = CashRegister::findOrFail($id);
        $request->validate([
            'actual_balance'=>'numeric',
            'status' =>'string|max:255',
            'operation_type'=>'boolean',
            'amount'=>'numeric',
        ], [
            'actual_balance.numeric' => 'Le solde doit être un nombre.',
            'status.string' => 'Le statut doit être une chaîne de caractères.',
            'status.max' => 'Le statut ne doit pas dépasser 255 caractères',
            'operation_type.boolean' => 'Le type d\'opération doit être un booléen.',
            'amount.numeric' => 'Le montant doit être un nombre.',
        ]);
        $cashRegister->update($request->all());
        return response()->json($cashRegister, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cashRegister = CashRegister::findOrFail($id);
        $cashRegister->delete();
        return response()->json(null, 204);
    }

    public function updateCaisseBalance(Request $request)
    {
        $request->validate([
            'actual_balance'=>'numeric',
            'operation_type'=>'boolean|integer',
        ], [
            'actual_balance.numeric' => 'Le montant doit être un nombre.',
            'operation_type.boolean' => 'Le type d\'opération doit être un booléen.',
            'operation_type.integer' => 'Le type d\'opération doit être un entier.',
        ]);

        $caisse = new CashRegister();

        $caisse->updateSolde($request->actual_balance, $request->operation_type);

        return redirect()->back();
    }
}
