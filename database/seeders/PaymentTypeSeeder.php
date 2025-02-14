<?php

namespace Database\Seeders;

use App\Models\PaymentType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaymentType::create([
            'libelle' => 'Virement Bancaire',
            'description' => 'Paiement par transfert de fonds entre comptes bancaires.',
        ]);
        PaymentType::create([
            'libelle' => 'Chèque',
            'description' => 'Paiement via document bancaire signé.',
        ]);
        PaymentType::create([
            'libelle' => 'Espèces',
            'description' => 'Paiement en liquide (billets et pièces).',
        ]);
        PaymentType::create([
            'libelle' => 'Autre',
            'description' => 'Paiement par autre moyen',
        ]);
    }
}
