<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pet;
use App\Models\Owner;

class PetsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
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
        $animalTypes = array_keys($animals); // Obtener los tipos de animales
$animalBreeds = array_values($animals); // Obtener las razas de animales

$owners = Owner::all(); // Obtener todos los propietarios existentes

for ($i = 1; $i <= 5; $i++) {
    $randomTypeIndex = array_rand($animalTypes); // Obtener un índice aleatorio para el tipo
    $randomType = $animalTypes[$randomTypeIndex]; // Obtener el tipo aleatorio

    $randomBreedIndex = array_rand($animalBreeds[$randomTypeIndex]); // Obtener un índice aleatorio para la raza
    $randomBreed = $animalBreeds[$randomTypeIndex][$randomBreedIndex]; // Obtener la raza aleatoria

    Pet::create([
        'owner_id' => $owners->random()->id, // Asignar un propietario aleatorio
        'name' => 'Mascota ' . $i,
        'weight' => mt_rand(1, 20) / 10, // Generar un peso aleatorio entre 0.1 y 2.0
        'type' => $randomType, // Asignar el tipo aleatorio
        'breed' => $randomBreed, // Asignar la raza aleatoria
        'age' => mt_rand(1, 10),
    ]);
}

    }
}
