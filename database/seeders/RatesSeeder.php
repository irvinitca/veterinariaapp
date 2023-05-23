<?php

namespace Database\Seeders;

use App\Models\Rate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
            Rate::create([
                'service' => 'Rate Citas',
                'price' => 10, // Genera un número decimal aleatorio entre 1 y 10
            ]);
            Rate::create([
                'service' => 'Rate Corte',
                'price' => 5, // Genera un número decimal aleatorio entre 1 y 10
            ]);
            Rate::create([
                'service' => 'Rate Baño',
                'price' => 5, // Genera un número decimal aleatorio entre 1 y 10
            ]);
            
        
    }
}
