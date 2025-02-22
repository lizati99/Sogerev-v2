<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Exception;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        try {
            $clients = Client::all();
            if ($clients->isEmpty()) {
                return response()->json([
                    'message' => 'Aucun client trouvé',
                    'clients' => []
                ], 200);
            }
            return response()->json([
                'message' => 'Liste de tous les clients récupérée avec succès',
                'clients' => $clients
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la récupération de tous les clients : ' . $exception->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'rs'=> 'nullable|string|max:255',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:255',
            'region' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:255',
            'rib' => 'nullable|string|max:255',
            'isCompany' => 'nullable|boolean'
            // 'country' => ['string', 'max:255'],
        ],[
            'name.string' => 'Le nom doit être une chaîne de caractères.',
            'name.max' => 'Le nom du fournisseur ne doit pas dépasser 255 caractères.',
            'description.string' => 'La description doit être une chaîne de caractères.',
            'description.max' => 'La description ne doit pas dépasser 255 caractères.',
            'email.email' => 'L\'adresse email doit être valide.',
            'email.max' => 'L\'adresse email ne doit pas dépasser 255 caractères.',
            'rs.string' => 'Le R.S. doit être une chaîne de caractères.',
            'rs.max' => 'Le R.S. ne doit pas dépasser 255 caractères.',
            'address.string' => 'L\'adresse doit être une chaîne de caractères.',
            'city.string' => 'La ville du fournisseur doit être une chaîne de caractères.',
            'city.max' => 'La ville du fournisseur ne doit pas dépasser 255 caractères.',
            'region.string' => 'Le région du fournisseur doit être une chaîne de caractères.',
            'region.max' => 'Le région du fournisseur ne doit pas dépasser 255 caractères.',
            'postal_code.string' => 'Le code postal du fournisseur doit être une chaîne de caractères.',
            'postal_code.max' => 'Le code postal du fournisseur ne doit pas dépasser 255 caractères.',
            'phone_number.string' => 'Le numero de Téléphone doit être une chaîne de caractères.',
            'phone_number.max' => 'Le numero de Téléphone ne doit pas dépasser 255 caractères.',
            'rib.string' => 'Le RIB doit être une chaîne de caractères.',
            'rib.max' => 'Le RIB ne doit pas dépasser 255 caractères.',
            'isCompany.boolean' => 'Le champ "Est-ce une entreprise?" doit être un booléen.',
            // 'country.string' => 'Le pays du fournisseur doit être une chaîne de caractères.',
            // 'country.string' => 'Le pays du fournisseur doit être une chaîne de caractères.',
            // 'country.required' => 'Le pays du fournisseur est obligatoire.',
        ]);
        $client = Client::create($request->all());
        return response()->json($client, 201);
    }

    public function show(string $id)
    {
        $client = Client::findOrFail($id);
        return $client;
    }

    public function update(Request $request, string $id)
    {
        $client = Client::findOrFail($id);
        $request->validate([
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'rs'=> 'nullable|string|max:255',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:255',
            'region' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:255',
            'rib' => 'nullable|string|max:255',
            'isCompany' => 'nullable|boolean'
            // 'country' => ['string', 'max:255'],
        ],[
            'name.string' => 'Le nom doit être une chaîne de caractères.',
            'name.max' => 'Le nom du fournisseur ne doit pas dépasser 255 caractères.',
            'description.string' => 'La description doit être une chaîne de caractères.',
            'description.max' => 'La description ne doit pas dépasser 255 caractères.',
            'email.email' => 'L\'adresse email doit être valide.',
            'email.max' => 'L\'adresse email ne doit pas dépasser 255 caractères.',
            'rs.string' => 'Le R.S. doit être une chaîne de caractères.',
            'rs.max' => 'Le R.S. ne doit pas dépasser 255 caractères.',
            'address.string' => 'L\'adresse doit être une chaîne de caractères.',
            'city.string' => 'La ville du fournisseur doit être une chaîne de caractères.',
            'city.max' => 'La ville du fournisseur ne doit pas dépasser 255 caractères.',
            'region.string' => 'Le région du fournisseur doit être une chaîne de caractères.',
            'region.max' => 'Le région du fournisseur ne doit pas dépasser 255 caractères.',
            'postal_code.string' => 'Le code postal du fournisseur doit être une chaîne de caractères.',
            'postal_code.max' => 'Le code postal du fournisseur ne doit pas dépasser 255 caractères.',
            'phone_number.string' => 'Le numero de Téléphone doit être une chaîne de caractères.',
            'phone_number.max' => 'Le numero de Téléphone ne doit pas dépasser 255 caractères.',
            'rib.string' => 'Le RIB doit être une chaîne de caractères.',
            'rib.max' => 'Le RIB ne doit pas dépasser 255 caractères.',
            'isCompany.boolean' => 'Le champ "Est-ce une entreprise?" doit être un booléen.',
            // 'country.string' => 'Le pays du fournisseur doit être une chaîne de caractères.',
            // 'country.string' => 'Le pays du fournisseur doit être une chaîne de caractères.',
            // 'country.required' => 'Le pays du fournisseur est obligatoire.',
        ]);
        $client->update($request->all());
        return response()->json($client, 200);
    }

    public function destroy(string $id)
    {
        $client = Client::findOrFail($id);
        $client->delete();
        return response()->json(null, 204);
    }
}
