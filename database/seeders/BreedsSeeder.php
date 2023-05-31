<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Breed;
use App\Models\Type;
class BreedsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $breeds = [
            // Ejemplo para las razas de perros
            [
                'type' => 'Perro',
                'name' => 'Labrador Retriever',
            ],
            [
                'type' => 'Perro',
                'name' => 'Bulldog',
            ],
            // Ejemplo para las razas de gatos
            [
                'type' => 'Gato',
                'name' => 'Persa',
            ],
            [
                'type' => 'Gato',
                'name' => 'Siames',
            ],
            // Agrega más razas de animales aquí
        ];

        foreach ($breeds as $breed) {
            $type = Type::where('name', $breed['type'])->first();
            if ($type) {
                Breed::create([
                    'type_id' => $type->id,
                    'name' => $breed['name'],
                ]);
            }
        }
    }
}
