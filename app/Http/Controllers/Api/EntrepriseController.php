<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Entreprise;
use Exception;
use Illuminate\Http\Request;

class EntrepriseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $entreprises = Entreprise::all();
            if ($entreprises->isEmpty()) {
                return response()->json([
                    'message' => 'Aucune entreprise trouvé',
                    'entreprises' => []
                ], 200);
            }
            return response()->json([
                'message' => 'Liste de tous les entreprises récupérée avec succès',
                'entreprises' => $entreprises
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la récupération de tous les entreprises : ' . $exception->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' =>'string|max:255',
                'RS'=>'string|max:255',
                'description' =>'string|max:255',
                'phone_number_1'=>'string|max:255',
                'phone_number_2'=>'string|max:255',
                'fix'=>'string|max:255',
                'fax'=>'string|max:255',
                'address'=>'string|max:255',
                'city'=>'string|max:255',
                'email' =>'string|max:255|unique:entreprises',
                'siteweb' =>'string|max:255',
                'logo' =>'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
            ],[
                'name.string' => 'Le nom doit être une chaîne de caractères',
                'name.max' => 'Le nom ne doit pas dépasser 255 caractères',
                'RS.string' => 'Le R.S doit être une chaîne de caractères',
                'RS.max' => 'Le R.S ne doit pas dépasser 255 caractères',
                'description.string' => 'La description doit être une chaîne de caractères',
                'description.max' => 'La description ne doit pas dépasser 255 caractères',
                'phone_number_1.string' => 'Le numéro de téléphone 1 doit être une chaîne de caractères',
                'phone_number_1.max' => 'Le numéro de téléphone 1 ne doit pas dépasser 255 caractères',
                'phone_number_2.string' => 'Le numéro de téléphone 2 doit être une chaîne de caractères',
                'phone_number_2.max' => 'Le numéro de téléphone 2 ne doit pas dépasser 255 caractères',
                'fix.string' => 'Le numéro de fixe doit être une chaîne de caractères',
                'fix.max' => 'Le numéro de fixe ne doit pas dépasser 255 caractères',
                'fax.string' => 'Le numéro de fax doit être une chaîne de caractères',
                'fax.max' => 'Le numéro de fax ne doit pas dépasser 255 caractères',
                'address.string' => 'L\'adresse doit être une chaîne de caractères',
                'address.max' => 'L\'adresse ne doit pas dépasser 255 caractères',
                'city.string' => 'La ville doit être une chaîne de caractères',
                'city.max' => 'La ville ne doit pas dépasser 255 caractères',
                'email.string' => 'L\'email doit être une chaîne de caractères',
                'email.max' => 'L\'email ne doit pas dépasser 255 caractères',
                'email.unique' => 'Cet email est déjà utilisé',
                'siteweb.string' => 'Le site web doit être une chaîne de caractères',
                'logo.image' => 'Le logo doit être une image (jpeg, png, jpg ou webp)',
                'logo.mimes' => 'Le logo doit être au format jpeg, png, jpg ou webp',
                'logo.max' => 'La taille de l\'image ne doit pas dépasser 2MB'
            ]);

            // $logo = $request->hasFile('logo') ? $request->file('logo')->store('images/entreprise', 'public') : null;
            $entreprise = Entreprise::create($request->all());
            return response()->json($entreprise, 201);
        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la création de le entreprise : ' . $exception->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $entreprise = Entreprise::findOrFail($id);
            return response()->json($entreprise, 200);
        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la récupération des détails de le entreprise : ' . $exception->getMessage()
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $entreprise = Entreprise::findOrFail($id);
            $request->validate([
                'name' =>'string|max:255',
                'RS'=>'string|max:255',
                'description' =>'string|max:255',
                'phone_number_1'=>'string|max:255',
                'phone_number_2'=>'string|max:255',
                'fix'=>'string|max:255',
                'fax'=>'string|max:255',
                'address'=>'string|max:255',
                'city'=>'string|max:255',
                'email' =>'string|max:255|unique:entreprises',
                'siteweb' =>'string|max:255',
                'logo' =>'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
            ],[
                'name.string' => 'Le nom doit être une chaîne de caractères',
                'name.max' => 'Le nom ne doit pas dépasser 255 caractères',
                'RS.string' => 'Le R.S doit être une chaîne de caractères',
                'RS.max' => 'Le R.S ne doit pas dépasser 255 caractères',
                'description.string' => 'La description doit être une chaîne de caractères',
                'description.max' => 'La description ne doit pas dépasser 255 caractères',
                'phone_number_1.string' => 'Le numéro de téléphone 1 doit être une chaîne de caractères',
                'phone_number_1.max' => 'Le numéro de téléphone 1 ne doit pas dépasser 255 caractères',
                'phone_number_2.string' => 'Le numéro de téléphone 2 doit être une chaîne de caractères',
                'phone_number_2.max' => 'Le numéro de téléphone 2 ne doit pas dépasser 255 caractères',
                'fix.string' => 'Le numéro de fixe doit être une chaîne de caractères',
                'fix.max' => 'Le numéro de fixe ne doit pas dépasser 255 caractères',
                'fax.string' => 'Le numéro de fax doit être une chaîne de caractères',
                'fax.max' => 'Le numéro de fax ne doit pas dépasser 255 caractères',
                'address.string' => 'L\'adresse doit être une chaîne de caractères',
                'address.max' => 'L\'adresse ne doit pas dépasser 255 caractères',
                'city.string' => 'La ville doit être une chaîne de caractères',
                'city.max' => 'La ville ne doit pas dépasser 255 caractères',
                'email.string' => 'L\'email doit être une chaîne de caractères',
                'email.max' => 'L\'email ne doit pas dépasser 255 caractères',
                'email.unique' => 'Cet email est déjà utilisé',
                'siteweb.string' => 'Le site web doit être une chaîne de caractères',
                'logo.image' => 'Le logo doit être une image (jpeg, png, jpg ou webp)',
                'logo.mimes' => 'Le logo doit être au format jpeg, png, jpg ou webp',
                'logo.max' => 'La taille de l\'image ne doit pas dépasser 2MB'
            ]);
            $entreprise->update($request->all());
            return response()->json($entreprise, 200);
        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la mise à jour de le entreprise : ' . $exception->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $entreprise = Entreprise::findOrFail($id);
            $entreprise->delete();
            return response()->json(null, 204);
        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la suppression de le entreprise : ' . $exception->getMessage()
            ], 500);
        }
    }
}
