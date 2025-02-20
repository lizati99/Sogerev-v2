<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create([
            'libelle' => 'gérer les utilisateurs',
            'description' => 'Gestion des utilisateurs (créer, modifier, supprimer).',
        ]);
        Permission::create([
            'libelle' => 'consulter les rapports',
            'description' => 'Voir les rapports.',
        ]);
        Permission::create([
            'libelle' => 'gérer les ventes',
            'description' => 'Gestion des ventes.',
        ]);
        Permission::create([
            'libelle' => 'tableau de bord d\'accès',
            'description' => 'Accès au panneau de contrôle.',
        ]);
        // Permission::factory(10)->create();
    }
}
