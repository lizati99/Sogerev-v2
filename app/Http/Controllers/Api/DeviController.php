<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Devi;
use App\Models\DevisLine;
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
            $devis = Devi::with("devisLines")->get();
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
        $validatedData = $request->validate([
            // devis
            'devis_number' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'subject' => 'nullable|string',
            'devis_date' => 'nullable|date',
            'expiration_date' => 'nullable|date|after_or_equal:devis_date',
            'total_HT' => 'nullable|numeric',
            'total_TVA' => 'nullable|numeric',
            'total_TTC' => 'nullable|numeric',
            'TVA_rate' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'note' => 'nullable|string',
            'status' => 'nullable|string|max:255',
            'created_by' => 'required|exists:users,id',
            'entreprise_id' => 'required|exists:entreprises,id',
            'client_id' => 'required|exists:clients,id',

            // ligne devis
            'devis_lines' => 'required|array|min:1',
            'devis_lines.*.designation' => 'nullable|string|max:255',
            'devis_lines.*.quantity' => 'nullable|numeric|min:0',
            'devis_lines.*.unit_price_HT' => 'nullable|numeric|min:0',
            'devis_lines.*.TVA_rate' => 'nullable|numeric|min:0',
            'devis_lines.*.total_TVA' => 'nullable|numeric|min:0',
            'devis_lines.*.total_HT' => 'nullable|numeric|min:0',
            'devis_lines.*.total_TTC' => 'nullable|numeric|min:0',
            'devis_lines.*.product_id' => 'nullable|exists:products,id',
            'devis_lines.*.devi_id' => 'nullable|exists:devis_lines,id',
        ], [
            // Devis
            'devis_number.string' => 'Le numéro du devis doit être une chaîne de caractères.',
            'devis_number.max' => 'Le numéro du devis ne doit pas dépasser 255 caractères.',
            'title.string' => 'Le titre du devis doit être une chaîne de caractères.',
            'title.max' => 'Le titre du devis ne doit pas dépasser 255 caractères.',
            'subject.string' => 'Le sujet du devis doit être une chaîne de caractères.',
            'devis_date.date' => 'La date du devis doit être valide.',
            'expiration_date.date' => 'La date d\'expiration doit être valide.',
            'expiration_date.after_or_equal' => 'La date d\'expiration doit être après ou égale à la date du devis.',
            'total_HT.numeric' => 'Le total HT doit être un nombre.',
            'total_TVA.numeric' => 'Le total TVA doit être un nombre.',
            'total_TTC.numeric' => 'Le total TTC doit être un nombre.',
            'TVA_rate.numeric' => 'Le taux de TVA doit être un nombre.',
            'discount.numeric' => 'La remise doit être un nombre.',
            'created_by.required' => 'Le créateur du devis est obligatoire.',
            'created_by.exists' => 'Le créateur du devis doit correspondre à un utilisateur existant.',
            'client_id.required' => 'Le client du devis est obligatoire.',
            'client_id.exists' => 'Le client du devis doit correspondre à un client existant.',

            // Ligne Devis
            'devis_lines.required' => 'Au moins une ligne de devis est requise.',
            'devis_lines.array' => 'Les lignes de devis doivent être sous forme de tableau.',
            'devis_lines.min' => 'Il faut au moins une ligne de devis.',
            'devis_lines.*.designation.string' => 'La désignation doit être une chaîne de caractères.',
            'devis_lines.*.designation.max' => 'La désignation ne doit pas dépasser 255 caractères.',
            'devis_lines.*.quantity.numeric' => 'La quantité doit être un nombre.',
            'devis_lines.*.quantity.min' => 'La quantité doit être au moins 0.',
            'devis_lines.*.unit_price_HT.numeric' => 'Le prix unitaire HT doit être un nombre.',
            'devis_lines.*.unit_price_HT.min' => 'Le prix unitaire HT doit être positif.',
            'devis_lines.*.TVA_rate.numeric' => 'Le taux de TVA doit être un nombre.',
            'devis_lines.*.TVA_rate.min' => 'Le taux de TVA doit être positif.',
            'devis_lines.*.total_TVA.numeric' => 'Le total TVA doit être un nombre.',
            'devis_lines.*.total_TVA.min' => 'Le total TVA doit être positif.',
            'devis_lines.*.total_HT.numeric' => 'Le total HT doit être un nombre.',
            'devis_lines.*.total_HT.min' => 'Le total HT doit être positif.',
            'devis_lines.*.total_TTC.numeric' => 'Le total TTC doit être un nombre.',
            'devis_lines.*.total_TTC.min' => 'Le total TTC doit être positif.',
            'devis_lines.*.product_id.required' => 'Le produit est obligatoire.',
            'devis_lines.*.product_id.exists' => 'Le produit sélectionné n\'existe pas.',
            'devis_lines.*.devi_id.required' => 'Le devis est obligatoire.',
            'devis_lines.*.devi_id.exists' => 'Le devis sélectionné n\'existe pas.',
        ]);

        // Devis
        $devi = Devi::create($validatedData);

        // Ligne Devi
        foreach ($validatedData['devis_lines'] as $ligne) {
            $ligne['devi_id'] = $devi->id;
            DevisLine::create($ligne);
        }

        return response()->json($devi, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $devi = Devi::with("devisLines")->findOrFail($id);
        return response()->json($devi, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $devi = Devi::findOrFail($id);

        $validatedData = $request->validate([
            // devis
            'devis_number' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'subject' => 'nullable|string',
            'devis_date' => 'nullable|date',
            'expiration_date' => 'nullable|date|after_or_equal:devis_date',
            'total_HT' => 'nullable|numeric',
            'total_TVA' => 'nullable|numeric',
            'total_TTC' => 'nullable|numeric',
            'TVA_rate' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'note' => 'nullable|string',
            'status' => 'nullable|string|max:255',
            'updated_by' => 'required|exists:users,id',
            'entreprise_id' => 'required|exists:entreprises,id',
            'client_id' => 'required|exists:clients,id',

            // ligne devis
            'devis_lines' => 'required|array|min:1',
            'devis_lines.*.id' => 'nullable',
            'devis_lines.*.designation' => 'nullable|string|max:255',
            'devis_lines.*.quantity' => 'nullable|numeric|min:0',
            'devis_lines.*.unit_price_HT' => 'nullable|numeric|min:0',
            'devis_lines.*.TVA_rate' => 'nullable|numeric|min:0',
            'devis_lines.*.total_TVA' => 'nullable|numeric|min:0',
            'devis_lines.*.total_HT' => 'nullable|numeric|min:0',
            'devis_lines.*.total_TTC' => 'nullable|numeric|min:0',
            'devis_lines.*.product_id' => 'nullable|exists:products,id',
            'devis_lines.*.devi_id' => 'nullable|exists:devis,id',
        ], [
            // Devis
            'devis_number.string' => 'Le numéro du devis doit être une chaîne de caractères.',
            'devis_number.max' => 'Le numéro du devis ne doit pas dépasser 255 caractères.',
            'title.string' => 'Le titre du devis doit être une chaîne de caractères.',
            'title.max' => 'Le titre du devis ne doit pas dépasser 255 caractères.',
            'subject.string' => 'Le sujet du devis doit être une chaîne de caractères.',
            'devis_date.date' => 'La date du devis doit être valide.',
            'expiration_date.date' => 'La date d\'expiration doit être valide.',
            'expiration_date.after_or_equal' => 'La date d\'expiration doit être après ou égale à la date du devis.',
            'total_HT.numeric' => 'Le total HT doit être un nombre.',
            'total_TVA.numeric' => 'Le total TVA doit être un nombre.',
            'total_TTC.numeric' => 'Le total TTC doit être un nombre.',
            'TVA_rate.numeric' => 'Le taux de TVA doit être un nombre.',
            'discount.numeric' => 'La remise doit être un nombre.',
            'updated_by.required' => 'Le Modifié du devis est obligatoire.',
            'updated_by.exists' => 'Le Modifié du devis doit correspondre à un utilisateur existant.',
            'client_id.required' => 'Le client du devis est obligatoire.',
            'client_id.exists' => 'Le client du devis doit correspondre à un client existant.',

            // Ligne Devis
            'devis_lines.required' => 'Au moins une ligne de devis est requise.',
            'devis_lines.array' => 'Les lignes de devis doivent être sous forme de tableau.',
            'devis_lines.min' => 'Il faut au moins une ligne de devis.',
            // 'devis_lines.*.id.required' => 'L\'ID de la ligne de devis est obligatoire.',
            'devis_lines.*.designation.string' => 'La désignation doit être une chaîne de caractères.',
            'devis_lines.*.designation.max' => 'La désignation ne doit pas dépasser 255 caractères.',
            'devis_lines.*.quantity.numeric' => 'La quantité doit être un nombre.',
            'devis_lines.*.quantity.min' => 'La quantité doit être au moins 0.',
            'devis_lines.*.unit_price_HT.numeric' => 'Le prix unitaire HT doit être un nombre.',
            'devis_lines.*.unit_price_HT.min' => 'Le prix unitaire HT doit être positif.',
            'devis_lines.*.TVA_rate.numeric' => 'Le taux de TVA doit être un nombre.',
            'devis_lines.*.TVA_rate.min' => 'Le taux de TVA doit être positif.',
            'devis_lines.*.total_TVA.numeric' => 'Le total TVA doit être un nombre.',
            'devis_lines.*.total_TVA.min' => 'Le total TVA doit être positif.',
            'devis_lines.*.total_HT.numeric' => 'Le total HT doit être un nombre.',
            'devis_lines.*.total_HT.min' => 'Le total HT doit être positif.',
            'devis_lines.*.total_TTC.numeric' => 'Le total TTC doit être un nombre.',
            'devis_lines.*.total_TTC.min' => 'Le total TTC doit être positif.',
            'devis_lines.*.product_id.required' => 'Le produit est obligatoire.',
            'devis_lines.*.product_id.exists' => 'Le produit sélectionné n\'existe pas.',
            'devis_lines.*.devi_id.exists' => 'Le devis sélectionné n\'existe pas.',
        ]);

        $devi->update($validatedData);

        $existingLigneIds = $devi->devisLines()->pluck('id')->toArray();
        $newLigneIds = [];

        foreach ($validatedData['devis_lines'] as $ligne) {
            if (isset($ligne['id']) && in_array($ligne['id'], $existingLigneIds)) {
                DevisLine::where('id', $ligne['id'])->update($ligne);
                $newLigneIds[] = $ligne['id'];
            } else {
                // add new ligne if it not exists in database
                $ligne['devi_id'] = $devi->id;
                $newLigne = DevisLine::create($ligne);
                $newLigneIds[] = $newLigne->id;
            }
        }

        // Delete lines no present
        DevisLine::where('devi_id', $devi->id)
            ->whereNotIn('id', $newLigneIds)
            ->delete();

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
