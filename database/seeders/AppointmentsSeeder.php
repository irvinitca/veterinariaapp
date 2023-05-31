<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Appointment;
use App\Models\Pet;
use App\Models\Rate;
use App\Models\User;


class AppointmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $pets = Pet::pluck('id'); // Obtener todos los IDs de mascotas existentes
        $users =User::whereHas(
            'roles', function($q){
                $q->where('name', 'Veterinario');
            }
        )->pluck('id'); // Obtener todos los IDs de usuarios existentes

        for ($i = 1; $i <= 20; $i++) {
            Appointment::create([
                'pet_id' => $pets->random(),
                'user_id' => $users->random(),
                'status' => ['Activo', 'Cerrado', 'Cancelado'][rand(0, 2)],
                'date_start' => now()->addDays($i),
                'reason' => 'Motivo ' . $i,
                'type' => ['Consulta', 'Emergencia'][rand(0, 1)],
            ]);
        }
    }
}
