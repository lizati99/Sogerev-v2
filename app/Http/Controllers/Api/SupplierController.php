<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Exception;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        try {
            $suppliers = Supplier::all();
            if ($suppliers->isEmpty()) {
                return response()->json([
                    'message' => 'Aucun Fournisseur trouvé',
                    'suppliers' => []
                ], 200);
            }
            return response()->json([
                'message' => 'Liste de tous les Fournisseurs récupérée avec succès',
                'suppliers' => $suppliers
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la récupération des Fournisseurs : ' . $exception->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'nullable|string|max:255',
                'description' => 'nullable|string|max:255',
                'email' => 'nullable|email|max:255',
                'rs'=> 'nullable|string|max:255',
                'address' => 'nullable|string',
                'city' => 'nullable|string|max:255',
                'region' => 'nullable|string|max:255',
                'postal_code' => 'nullable|string|max:255',
                // 'country' => ['string', 'max:255'],
                'phone_number' => 'nullable|string|max:255',
                'rib' => 'nullable|string|max:255',
                'isCompany' => 'nullable|boolean|integer|max:255'
            ]);
            $supplier = Supplier::create($request->all());
            return response()->json($supplier, 201);
        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la création de le fournisseur : ' . $exception->getMessage()
            ], 500);
        }
    }

    public function show(string $id)
    {
        try {
            $supplier = Supplier::findOrFail($id);
            return $supplier;
        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la récupération des détails de le fournisseur : ' . $exception->getMessage()
            ], 404);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $supplier = Supplier::findOrFail($id);
            $request->validate([
                'name' => ['string','max:255'],
                'description' => ['string','max:255'],
                'email' => ['email','max:255'],
                'rs'=>['string','max:255'],
                'address' => ['string'],
                'city' => ['string', 'max:255'],
                'region' => ['string', 'max:255'],
                'postal_code' => ['string', 'max:255'],
                // 'country' => ['string', 'max:255'],
                'phone_number' => ['string', 'email','max:255'],
                'rib' => ['string','max:255'],
                'isCompany' => ['string','max:255']
            ]);
            $supplier->update($request->all());
            return response()->json($supplier, 200);
        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la mise à jour de le fournisseur : ' . $exception->getMessage()
            ], 500);
        }
        }

    public function destroy(string $id)
    {
        try {
            $supplier = Supplier::findOrFail($id);
            $supplier->delete();
            return response()->json(null, 204);
        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la suppression de le fournisseur : ' . $exception->getMessage()
            ], 500);
        }
    }
}
