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
        $animals = [
            'Caninos' => [
                'Golden retriever',
                'Bulldog francés',
                'Pastor alemán',
                'Rottweile',
                'Beagle',
            ],
            'Felinos' => [
                'Siberiano',
                'Angora',
                'Siamés',
                'Bengalí',
                'Persa',
            ],
            'Aves' => [
                'Loro',
                'Perico coumn',
                'Perico Australiano',
                'Cacatua',
                'Tucan',
            ],
            'Roedores' => [
                'Hamster',
                'Cobaya',
                'Conejo',
                'Rata',
                'Raton',
            ],
            'Reptiles' => [
                'Serpiente',
                'Lagartija',
                'Tortuga',
                'Camaleon',
                'Iguana',
            ],
        ];

        foreach ($animals as $type => $breeds) {
            $animalType = Type::create([
                'name' => $type,
            ]);

            foreach ($breeds as $breed) {
                Breed::create([
                    'type_id' => $animalType->id,
                    'name' => $breed,
                ]);
            }
        }
    }
}
