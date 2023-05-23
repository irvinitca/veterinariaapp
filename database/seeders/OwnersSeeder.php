<?php

namespace Database\Seeders;

use App\Models\Owner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OwnersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            Owner::create([
                'name' => 'Owner ' . $i,
                'age' => mt_rand(18, 65),
                'dui' => '12345678-' . mt_rand(100, 999),
                'phone' => '12345678' . mt_rand(100, 999),
            ]);
        }
    }
}
