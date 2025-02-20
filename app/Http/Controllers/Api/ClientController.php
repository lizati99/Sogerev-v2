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
            'name' =>'string|max:255',
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
            'name' =>'string|max:255',
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
