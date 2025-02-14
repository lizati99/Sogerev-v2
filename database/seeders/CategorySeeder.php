<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'libelle' => 'Marbre Careaux',
            'description' => 'Récouvert de carrelage, utilisé pour les sols et murs.',
        ]);
        Category::create([
            'libelle' => 'Marbre',
            'description' => 'Pierre naturelle utilisée pour les surfaces et les décorations.',
        ]);
        Category::create([
            'libelle' => 'Granite',
            'description' => 'Pierre résistante aux rayures et à la chaleur, idéale pour les cuisines et revêtements extérieurs.',
        ]);
        Category::create([
            'libelle' => 'Céramique',
            'description' => 'Carreaux artisanaux en terre cuite émaillée, typiques de l\'architecture marocaine.',
        ]);
        Category::create([
            'libelle' => 'Accessoires',
            'description' => 'Roche naturelle élégante et durable, utilisée pour les sols, murs et plans de travail.',
        ]);
    }
}
