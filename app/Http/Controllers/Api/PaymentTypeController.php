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
            'name' =>'string|max:255',
        ]);
        $paymentType = PaymentType::create($request->all());
        return response()->json($paymentType, 201);
    }

    public function show(paymentType $paymentType)
    {
        $paymentType = PaymentType::findOrFail($paymentType);
        return $paymentType;
    }

    public function update(Request $request, PaymentType $paymentType)
    {
        $paymentType = PaymentType::findOrFail($paymentType);
        $request->validate([
            'name' =>'string|max:255',
        ]);
        $paymentType->update($request->all());
        return response()->json($paymentType, 200);
    }

    public function destroy(PaymentType $paymentType)
    {
        $paymentType = PaymentType::findOrFail($paymentType);
        $paymentType->delete();
        return response()->json(null, 204);
    }
}
