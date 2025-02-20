<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'libelle' => 'super administrateur',
            'description' => 'Il a tous les pouvoirs.',
        ]);
        Role::create([
            'libelle' => 'administrateur',
            'description' => 'Administrateur du système, habilité à gérer les utilisateurs et les rapports.',
        ]);
        Role::create([
            'libelle' => 'commercial',
            'description' => 'Directeur des ventes.',
        ]);
        Role::create([
            'libelle' => 'éditeur',
            'description' => 'Rédacteur de contenu.',
        ]);
        Role::create([
            'libelle' => 'utilisateur',
            'description' => 'Utilisateur normal sans privilèges administratifs.',
        ]);
        // Role::factory(10)->create();
    }
}
