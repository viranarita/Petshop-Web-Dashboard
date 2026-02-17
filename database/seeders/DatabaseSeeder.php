<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Pet;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str; // Import Str

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Services (if not already seeded, but we ran ServiceSeeder separately)
        $this->call(ServiceSeeder::class);

        // Customers & Pets
        $customer1 = Customer::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '081234567890',
            'address' => 'Jl. Merdeka No. 1',
        ]);
        
        Pet::create([
            'customer_id' => $customer1->id,
            'name' => 'Buddy',
            'type' => 'dog',
            'breed' => 'Golden Retriever',
        ]);

        $customer2 = Customer::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'phone' => '089876543210',
            'address' => 'Jl. Sudirman No. 2',
        ]);
        
        Pet::create([
            'customer_id' => $customer2->id,
            'name' => 'Luna',
            'type' => 'cat',
            'breed' => 'Persian',
        ]);
    }
}
