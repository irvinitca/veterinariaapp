<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Appointment;
use App\Models\History;

class HistoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $appointments = Appointment::all(); // Obtener todas las citas existentes

        foreach ($appointments as $appointment) {
            if ($appointment->status === 'Cerrado') {
                History::create([
                    'appointment_id' => $appointment->id,
                    'date_resolved' => now()->subDays(1),
                    'services' => 'consulta',
                    'diagnostic' => 'Diagnóstico para la cita ' . $appointment->id,
                ]);
                $appointment->total = 100;
                $appointment->save();
            }
            
           
        }
    }
}
