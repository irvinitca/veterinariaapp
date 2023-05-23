<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Appointment;
use App\Models\Pet;
use App\Models\Rate;

class AppointmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pets = Pet::all(); // Obtener todas las mascotas existentes
        $rates = Rate::all(); // Obtener todas las tarifas existentes

        for ($i = 1; $i <= 10; $i++) {
            Appointment::create([
                'pet_id' => $pets->random()->id, // Asignar una mascota aleatoria
                'date_start' => now()->addDays($i),
                'date_end' => now()->addDays($i)->addHours(2),
                'reason' => 'Motivo ' . $i,
                'type' => mt_rand(1, 3), // Generar un tipo de cita aleatorio entre 1 y 3
            ]);
        }
    }
}
