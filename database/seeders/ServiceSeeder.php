<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        Service::create([
            'name' => 'Full Grooming (Small Dog)',
            'description' => 'Bath, haircut, nail trim, ear cleaning for small dogs.',
            'price' => 150000,
            'duration_minutes' => 90,
        ]);

        Service::create([
            'name' => 'Full Grooming (Large Dog)',
            'description' => 'Bath, haircut, nail trim, ear cleaning for large dogs.',
            'price' => 250000,
            'duration_minutes' => 120,
        ]);

        Service::create([
            'name' => 'Cat Grooming',
            'description' => 'Bath, comb out, nail trim for cats.',
            'price' => 180000,
            'duration_minutes' => 90,
        ]);

        Service::create([
            'name' => 'Pet Hotel (Per Night)',
            'description' => 'Overnight stay with feeding and play time.',
            'price' => 100000,
            'duration_minutes' => 1440, // 24 hours
        ]);
    }
}
