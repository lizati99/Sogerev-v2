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
            'name'=>'string|max:255',
            'solde' =>'numeric',
            'status'=>'string|max:255',
            'typeOperation'=>'boolean|integer',
        ], [
            'name.string' => 'Le nom doit être une chaîne de caractères.',
            'solde.numeric' => 'Le solde doit être un nombre.',
            'status.string' => 'Le statut doit être une chaîne de caractères.',
            'typeOperation.boolean' => 'Le type d\'opération doit être un booléen.',
            'typeOperation.integer' => 'Le type d\'opération doit être un entier.',
        ]);
        $cashRegister = CashRegister::create($request->all());
        return response()->json($cashRegister, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(CashRegister $cashRegister)
    {
        $cashRegister = CashRegister::findOrFail($cashRegister);
        return response()->json($cashRegister, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CashRegister $cashRegister)
    {
        $cashRegister = CashRegister::findOrFail($cashRegister);
        $request->validate([
            'name'=>'string|max:255',
            'solde' =>'numeric',
            'status'=>'string|max:255',
            'typeOperation'=>'boolean|integer',
        ], [
            'name.string' => 'Le nom doit être une chaîne de caractères.',
            'solde.numeric' => 'Le solde doit être un nombre.',
            'status.string' => 'Le statut doit être une chaîne de caractères.',
            'typeOperation.boolean' => 'Le type d\'opération doit être un booléen.',
            'typeOperation.integer' => 'Le type d\'opération doit être un entier.',
        ]);
        $cashRegister->update($request->all());
        return response()->json($cashRegister, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CashRegister $cashRegister)
    {
        $cashRegister = CashRegister::findOrFail($cashRegister);
        $cashRegister->delete();
        return response()->json(null, 204);
    }
}
