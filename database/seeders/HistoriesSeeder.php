<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Appointment;
use App\Models\History;
use App\Models\User;
class HistoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $appointments = Appointment::all(); // Obtener todas las citas existentes
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'Recepcion');
        })->get();
        
        foreach ($appointments as $appointment) {
            if ($appointment->status === 'Pagado'||$appointment->status ==='Diagnosticada') {
                $randomUser = $users->random();
                History::create([
                    'appointment_id' => $appointment->id,
                    'date_resolved' => now()->subDays(1),
                    'services' => 'consulta',
                    'diagnostic' => 'Diagnóstico para la cita ' . $appointment->id,
                    'indications' => 'Indicaciones para la cita ' . $appointment->id,
                    'medicaments' => 'Medicamentos para la cita ' . $appointment->id
                ]);
                $appointment->total = rand(50, 100);
                $appointment->cobrador_id=$randomUser->id;
                $appointment->date_payed= now()->subDays(1);
                $appointment->save();
            }
            
           
        }
    }
}
