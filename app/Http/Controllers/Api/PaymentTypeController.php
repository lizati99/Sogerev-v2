<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PaymentType;
use Exception;
use Illuminate\Http\Request;

class PaymentTypeController extends Controller
{
    public function index()
    {
        try {
            $paymentTypes = PaymentType::all();
            if ($paymentTypes->isEmpty()) {
                return response()->json([
                    'message' => 'Aucun type de paiement trouvé',
                    'paymentTypes' => []
                ], 200);
            }
            return response()->json([
                'message' => 'Liste de tous les types de paiement récupérée avec succès',
                'paymentTypes' => $paymentTypes
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la récupération de tous les types de paiement : ' . $exception->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'libelle' =>'nullable|string|max:255',
            'description' =>'nullable|string|max:255'
        ],[
            'libelle.string' => 'Le libelle doit être une chaîne de caractères',
            'libelle.max' => 'Le libelle ne doit pas dépasser 255 caractères',
            'description.string' => 'La description doit être une chaîne de caractères',
            'description.max' => 'La description ne doit pas dépasser 255 caractères'
        ]);
        $paymentType = PaymentType::create($request->all());
        return response()->json($paymentType, 201);
    }

    public function show(string $id)
    {
        $paymentType = PaymentType::findOrFail($id);
        return $paymentType;
    }

    public function update(Request $request, string $id)
    {
        $paymentType = PaymentType::findOrFail($id);
        $request->validate([
            'libelle' =>'nullable|string|max:255',
            'description' =>'nullable|string|max:255'
        ],[
            'libelle.string' => 'Le libelle doit être une chaîne de caractères',
            'libelle.max' => 'Le libelle ne doit pas dépasser 255 caractères',
            'description.string' => 'La description doit être une chaîne de caractères',
            'description.max' => 'La description ne doit pas dépasser 255 caractères'
        ]);
        $paymentType->update($request->all());
        return response()->json($paymentType, 200);
    }

    public function destroy(string $id)
    {
        $paymentType = PaymentType::findOrFail($id);
        $paymentType->delete();
        return response()->json(null, 204);
    }
}
