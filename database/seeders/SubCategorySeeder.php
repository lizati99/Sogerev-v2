<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubCategory::create([
            'libelle' => 'Marbre Careaux',
            'description' => 'Récouvert de carrelage, utilisé pour les sols et murs.',
            'category_id' => 1,
        ]);
        SubCategory::create([
            'libelle' => 'Marbre',
            'description' => 'Pierre naturelle utilisée pour les surfaces et les décorations.',
            'category_id' => 1,
        ]);
        SubCategory::create([
            'libelle' => 'Granite',
            'description' => 'Pierre résistante aux rayures et à la chaleur, idéale pour les cuisines et revêtements extérieurs.',
            'category_id' => 2,
        ]);
        SubCategory::create([
            'libelle' => 'Céramique',
            'description' => 'Carreaux artisanaux en terre cuite émaillée, typiques de l\'architecture marocaine.',
            'category_id' => 3,
        ]);
        SubCategory::create([
            'libelle' => 'Accessoires',
            'description' => 'Roche naturelle élégante et durable, utilisée pour les sols, murs et plans de travail.',
            'category_id' => 4,
        ]);
    }
}
