<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => '',
        //     'email' => 'admin@example.com',
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            PermissionSeeder::class,
            RolePermissionSeeder::class,
            PaymentTypeSeeder::class,
            ClientSeeder::class,
            SupplierSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            SubCategorySeeder::class,
            StockSeeder::class,
            EntrepriseSeeder::class,
        ]);
    }
}
