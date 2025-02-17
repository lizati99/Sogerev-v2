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
        $request->validate([
            'name' => ['string','max:255'],
            'description' => ['string','max:255'],
            'address' => ['string'],
            'city' => ['string', 'max:255'],
            'region' => ['string', 'max:255'],
            'postal_code' => ['string', 'max:255'],
            'country' => ['string', 'max:255'],
            'email' => ['string', 'email','max:255'],
            'phone_number' => ['string','max:255'],
            'contact' => ['string','max:255'],
            'website' => ['string','max:255']
        ]);
        $supplier = Supplier::create($request->all());
        return response()->json($supplier, 201);
    }

    public function show(Supplier $supplier)
    {
        $supplier = Supplier::findOrFail($supplier);
        return $supplier;
    }

    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'name' => ['string','max:255'],
            'description' => ['string','max:255'],
            'address' => ['string'],
            'city' => ['string', 'max:255'],
            'region' => ['string', 'max:255'],
            'postal_code' => ['string', 'max:255'],
            'country' => ['string', 'max:255'],
            'email' => ['string', 'email','max:255'],
            'phone_number' => ['string','max:255'],
            'contact' => ['string','max:255'],
            'website' => ['string','max:255']
        ]);
        $supplier->update($request->all());
        return response()->json($supplier, 200);
    }

    public function destroy(Supplier $supplier)
    {
        $supplier = Supplier::findOrFail($supplier);
        $supplier->delete();
        return response()->json(null, 204);
    }
}
