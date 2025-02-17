<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $users = User::all();
            if ($users->isEmpty()) {
                return response()->json([
                    'message' => 'Aucun utilisateur trouvé',
                    'users' => []
                ], 200);
            }
            return response()->json([
                'message' => 'Liste de tous les utilisateurs récupérée avec succès',
                'users' => $users
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la récupération de tous les utilisateurs : ' . $exception->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' =>'string|max:255',
        ], [
            'name.string' => 'Le nom doit être une chaîne de caractères.',
        ]);
        $user = User::create($request->all());
        return response()->json($user, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user = User::findOrFail($user);
        return response()->json($user, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $user = User::findOrFail($user);
        $request->validate([
            'name' =>'string|max:255',
        ]);
        $user->update($request->all());
        return response()->json($user, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user = User::findOrFail($user);
        $user->delete();
        return response()->json(null, 204);
    }
}
