<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Client::factory(10)->create();
        // Client::create([
        //     'name' => 'John Doe',
        //     'email' => 'john.doe@example.com',
        //     'phone_number' => '+1 123 456 7890',
        //     'address' => '123 Main St',
        //     'city' => 'New York',
        //     'state' => 'NY',
        //     'postal_code' => '10001',
        //     'country' => 'USA',
        // ]);
        
    }
}
