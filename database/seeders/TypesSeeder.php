<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;
class TypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $types = [
            ['name' => 'Perro'],
            ['name' => 'Gato'],
            ['name' => 'Ave'],
            // Agrega más tipos de animales aquí
        ];

        foreach ($types as $type) {
            Type::create($type);
        }
    }
}
