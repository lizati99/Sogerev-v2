<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Exception;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        try {
            $roles = Role::with('permissions')->get();
            if ($roles->isEmpty()) {
                return response()->json([
                    'message' => 'Aucun role trouvé',
                    'roles' => []
                ], 200);
            }
            return response()->json([
                'message' => 'Liste de tous les roles récupérée avec succès',
                'roles' => $roles
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la récupération des roles : ' . $exception->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $request->validate(['libelle' => 'required|unique:roles']);
        $role = Role::create($request->all());
        return response()->json($role, 201);
    }

    public function show(string $id)
    {
        $role = Role::with('permissions')->findOrFail($id);
        return $role;
    }

    public function update(Request $request, string $id)
    {
        $role = Role::findOrFail($id);
        $request->validate(['libelle' => 'required|unique:roles']);
        $role->update($request->all());
        return response()->json($role, 200);
    }

    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return response()->json(null, 204);
    }
}
