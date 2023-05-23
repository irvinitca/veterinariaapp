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
        $owners = Owner::all(); // Obtener todos los propietarios existentes

        for ($i = 1; $i <= 10; $i++) {
            Pet::create([
                'owner_id' => $owners->random()->id, // Asignar un propietario aleatorio
                'name' => 'Mascota ' . $i,
                'weight' => mt_rand(1, 20) / 10, // Generar un peso aleatorio entre 0.1 y 2.0
                'breed' => 'Raza ' . $i,
                'type' => 'Tipo ' . $i,
                'age' => mt_rand(1, 10),
            ]);
        }
    }
}
