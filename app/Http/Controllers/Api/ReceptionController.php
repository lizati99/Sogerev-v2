<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reception;
use App\Models\ReceptionLine;
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
            $receptions = Reception::with('receptionLines')->get();
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
        try {
            $validatedData = $request->validate([
                'reception_number' => 'nullable|string|max:255|unique:receptions,reception_number',
                'sujet'=>'nullable|string',
                'reception_date'=>'nullable|date',
                'realization_date'=>'nullable|date',
                'experation_date'=>'nullable|date',
                'total_HT'=>'nullable|numeric',
                'total_TVA'=>'nullable|numeric',
                'total_TTC'=>'nullable|numeric',
                'TVA_rate'=>'nullable|numeric',
                'discount'=>'nullable|numeric',
                'status'=>'nullable|string:max:255',
                'remarque'=>'nullable|string',
                'createdBy'=>'nullable|exists:users,id',
                'supplier_id'=>'nullable|exists:suppliers,id',
                'payment_type_id'=>'nullable|exists:payment_types,id',
                'entreprise_id'=>'nullable|exists:entreprises,id',
                'cash_register_id'=>'nullable|exists:cash_registers,id',
                'reception_lines' => 'required|array',
                'reception_lines.*.designation' => 'nullable|string|max:255',
                'reception_lines.*.quantity' => 'nullable|numeric',
                'reception_lines.*.width' => 'nullable|numeric',
                'reception_lines.*.height' => 'nullable|numeric',
                'reception_lines.*.unitMeasure' => 'nullable|string|max:255',
                'reception_lines.*.productStatus' => 'nullable|string|max:255',
                'reception_lines.*.unitPriceHT' => 'nullable|numeric',
                'reception_lines.*.TVA_rate' => 'nullable|numeric',
                'reception_lines.*.totalTVA' => 'nullable|numeric',
                'reception_lines.*.totalHT' => 'nullable|numeric',
                'reception_lines.*.totalTTC' => 'nullable|numeric',
                'reception_lines.*.product_id' => 'nullable|exists:products,id',
                'reception_lines.*.stock_id' => 'nullable|exists:stocks,id',
            ], [
                'reception_number.string' => 'Le champ : Numéro de réception doit être une chaîne de caractères.',
                'reception_number.max' => 'Le champ : Numéro de réception ne doit pas dépasser 255 caractères.',
                'sujet.string' => 'Le champ : Sujet doit être une chaîne de caractères.',
                'reception_date.date' => 'Le champ : Date d\'achat doit être une date valide.',
                'realization_date.date' => 'Le champ : Date de réalisation doit être une date valide.',
                'experation_date.date' => 'Le champ : Date d\'expiration doit être une date valide.',
                'total_HT.numeric' => 'Le champ : Montant total HT doit être un nombre.',
                'total_TVA.numeric' => 'Le champ : Montant total TVA doit être un nombre.',
                'total_TTC.numeric' => 'Le champ : Montant total TTC doit être un nombre.',
                'TVA_rate.numeric' => 'Le champ : Taux de TVA doit être un nombre.',
                'discount.numeric' => 'Le champ : Remise doit être un nombre.',
                'status.string' => 'Le champ : État doit être une chaîne de caractères.',
                'status.max'=> 'Le champ : status de réception ne doit pas dépasser 255 caractères.',
                'remarque.string' => 'Le champ : Remarque doit être une chaîne de caractères.',
                'createdBy.exists' => 'Le champ : Créé par doit correspondre à un utilisateur existant',
                'supplier_id.exists' => 'Le fournisseur doit correspondre à un fournisseur existant',
                'payment_type_id.exists' => 'La type de paiement doit correspondre à une type existante',
                'entreprise_id.exists' => 'L\'entreprise doit correspondre à une entreprise existante',
                'cash_register_id.exists' => 'Le registre de caisse doit correspondre à un registre existant',
                'reception_lines.required' => 'Les lignes de réception sont obligatoires.',
                'reception_lines.*.designation.string' => 'Le champ : Désignation doit être une chaîne de caractères.',
                'reception_lines.*.designation.max' => 'Le champ : Désignation ne doit pas dépasser 255 caractères.',
                'reception_lines.*.quantity.numeric' => 'Le champ : Quantité doit être un nombre.',
                'reception_lines.*.width.numeric' => 'Le champ : Largeur doit être un nombre.',
                'reception_lines.*.height.numeric' => 'Le champ : Hauteur doit être un nombre.',
                'reception_lines.*.unitMeasure.string' => 'Le champ : Unité de mesure doit être une chaîne de caractères.',
                'reception_lines.*.unitMeasure.max'=>'Le champ : Unité de mesure ne doit pas dépasser 255 caractères.',
                'reception_lines.*.productStatus' => 'Le champ : État du produit doit être une chaîne de caractères.',
                'reception_lines.*.productStatus.max'=>'Le champ : État du produit ne doit pas dépasser 255 caractères.',
                'reception_lines.*.unitPriceHT.numeric' => 'Le champ : Prix unitaire HT doit être un nombre.',
                'reception_lines.*.TVA_rate.numeric' => 'Le champ : Taux de TVA doit être un nombre.',
                'reception_lines.*.totalTVA.numeric' => 'Le champ : Montant TVA total doit être un nombre.',
                'reception_lines.*.totalHT.numeric' => 'Le champ : Montant HT total doit être un nombre.',
                'reception_lines.*.totalTTC.numeric' => 'Le champ : Montant TTC total doit être un nombre.',
                'reception_lines.*.product_id.exists' => 'Le champ : Produit doit correspondre à un produit existant',
                'reception_lines.*.stock_id.exists' => 'Le champ : Stock doit correspondre à un stock existant',
            ]);
            $reception = Reception::create($validatedData);
            foreach ($validatedData['reception_lines'] as $line) {
                $line['reception_id'] = $reception->id;
                ReceptionLine::create($line);
            }
            return response()->json($reception, 201);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la création de bon de reception : ' . $exception->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $reception = Reception::with('receptionLines')->findOrFail($id);
            return response()->json($reception, 200);
        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la récupération des détails de bon de reception : ' . $exception->getMessage()
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $reception = Reception::findOrFail($id);
            $validatedData = $request->validate([
                'reception_number' => 'nullable|string|max:255',
                'sujet'=>'nullable|string',
                'reception_date'=>'nullable|date',
                'realization_date'=>'nullable|date',
                'experation_date'=>'nullable|date',
                'total_HT'=>'nullable|numeric',
                'total_TVA'=>'nullable|numeric',
                'total_TTC'=>'nullable|numeric',
                'TVA_rate'=>'nullable|numeric',
                'discount'=>'nullable|numeric',
                'status'=>'nullable|string:max:255',
                'remarque'=>'nullable|string',
                'updatedBy'=>'nullable|exists:users,id',
                'supplier_id'=>'nullable|exists:suppliers,id',
                'payment_type_id'=>'nullable|exists:payment_types,id',
                'entreprise_id'=>'nullable|exists:entreprises,id',
                'cash_register_id'=>'nullable|exists:cash_registers,id',
                'reception_lines' => 'nullable|array',
                'reception_lines.*.designation' => 'nullable|string|max:255',
                'reception_lines.*.quantity' => 'nullable|numeric',
                'reception_lines.*.width' => 'nullable|numeric',
                'reception_lines.*.height' => 'nullable|numeric',
                'reception_lines.*.unitMeasure' => 'nullable|string|max:255',
                'reception_lines.*.productStatus' => 'nullable|string|max:255',
                'reception_lines.*.unitPriceHT' => 'nullable|numeric',
                'reception_lines.*.TVA_rate' => 'nullable|numeric',
                'reception_lines.*.totalTVA' => 'nullable|numeric',
                'reception_lines.*.totalHT' => 'nullable|numeric',
                'reception_lines.*.totalTTC' => 'nullable|numeric',
                'reception_lines.*.product_id' => 'nullable|exists:products,id',
                'reception_lines.*.stock_id' => 'nullable|exists:stocks,id',
            ], [
                'reception_number.string' => 'Le champ : Numéro de réception doit être une chaîne de caractères.',
                'reception_number.max' => 'Le champ : Numéro de réception ne doit pas dépasser 255 caractères.',
                'sujet.string' => 'Le champ : Sujet doit être une chaîne de caractères.',
                'reception_date.date' => 'Le champ : Date d\'achat doit être une date valide.',
                'realization_date.date' => 'Le champ : Date de réalisation doit être une date valide.',
                'experation_date.date' => 'Le champ : Date d\'expiration doit être une date valide.',
                'total_HT.numeric' => 'Le champ : Montant total HT doit être un nombre.',
                'total_TVA.numeric' => 'Le champ : Montant total TVA doit être un nombre.',
                'total_TTC.numeric' => 'Le champ : Montant total TTC doit être un nombre.',
                'TVA_rate.numeric' => 'Le champ : Taux de TVA doit être un nombre.',
                'discount.numeric' => 'Le champ : Remise doit être un nombre.',
                'status.string' => 'Le champ : État doit être une chaîne de caractères.',
                'status.max'=> 'Le champ : status de réception ne doit pas dépasser 255 caractères.',
                'remarque.string' => 'Le champ : Remarque doit être une chaîne de caractères.',
                'updatedBy.exists' => 'Le champ : Modifié par doit correspondre à un utilisateur existant',
                'supplier_id.exists' => 'Le fournisseur doit correspondre à un fournisseur existant',
                'payment_type_id.exists' => 'La type de paiement doit correspondre à une type existante',
                'entreprise_id.exists' => 'L\'entreprise doit correspondre à une entreprise existante',
                'cash_register_id.exists' => 'Le registre de caisse doit correspondre à un registre existant',
                'reception_lines.*.designation.string' => 'Le champ : Désignation doit être une chaîne de caractères.',
                'reception_lines.*.designation.max' => 'Le champ : Désignation ne doit pas dépasser 255 caractères.',
                'reception_lines.*.quantity.numeric' => 'Le champ : Quantité doit être un nombre.',
                'reception_lines.*.width.numeric' => 'Le champ : Largeur doit être un nombre.',
                'reception_lines.*.height.numeric' => 'Le champ : Hauteur doit être un nombre.',
                'reception_lines.*.unitMeasure.string' => 'Le champ : Unité de mesure doit être une chaîne de caractères.',
                'reception_lines.*.unitMeasure.max'=>'Le champ : Unité de mesure ne doit pas dépasser 255 caractères.',
                'reception_lines.*.productStatus' => 'Le champ : État du produit doit être une chaîne de caractères.',
                'reception_lines.*.productStatus.max'=>'Le champ : État du produit ne doit pas dépasser 255 caractères.',
                'reception_lines.*.unitPriceHT.numeric' => 'Le champ : Prix unitaire HT doit être un nombre.',
                'reception_lines.*.TVA_rate.numeric' => 'Le champ : Taux de TVA doit être un nombre.',
                'reception_lines.*.totalTVA.numeric' => 'Le champ : Montant TVA total doit être un nombre.',
                'reception_lines.*.totalHT.numeric' => 'Le champ : Montant HT total doit être un nombre.',
                'reception_lines.*.totalTTC.numeric' => 'Le champ : Montant TTC total doit être un nombre.',
                'reception_lines.*.product_id.exists' => 'Le champ : Produit doit correspondre à un produit existant',
                'reception_lines.*.stock_id.exists' => 'Le champ : Stock doit correspondre à un stock existant',
            ]);
            $reception->update($request->all());
            return response()->json($reception, 200);
        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la mise à jour de bon de reception : ' . $exception->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $reception = Reception::findOrFail($id);
            $reception->delete();
            return response()->json(null, 204);
        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la suppression de bon de reception : ' . $exception->getMessage()
            ], 500);
        }
    }
}
