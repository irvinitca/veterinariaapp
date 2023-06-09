<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\History;
use App\Models\Pet;
use App\Models\User;
use App\Models\Role;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HistoryController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        if ($user->hasRole('Administrador')) {
            return view('admin.dashboard', compact('users'));
        } elseif ($user->hasRole('Recepcion')) {
            $appointments = Appointment::orderByDesc('date_start')->paginate(10);
            return view('recepcion.dashboard', compact('appointments'));
        }elseif ($user->hasRole('Veterinario')) {
                    // Obtener el ID del paciente desde la solicitud
        $petId = $request->input('pet_id');

        // Obtener los diagnósticos del paciente
        $histories = History::whereHas('appointment', function ($query) use ($petId) {
            $query->whereHas('pet', function ($query) use ($petId) {
                $query->where('id', $petId);
            });
        })->get();

        // Cargar la vista diagnosticos-dashboard y pasar los diagnósticos
        return view('vet.diagnosticos-dashboard', compact('histories'));
        }
         else {
            return view('dashboard');
        }

    }


    public function create(Request $request)
    {
        // Obtener el ID del usuario autenticado
         $userId = Auth::id();
        // Obtener el ID de la cita desde la solicitud
         $appointmentId = $request->input('appointment_id');
           // Obtener las citas cerradas del paciente
         $appointments = Appointment::where('user_id', $userId)
         ->where('status', 'Cerrado')
         ->get();
          // Obtener los diagnósticos asociados a las citas cerradas
          $histories = History::whereIn('appointment_id', $appointments->pluck('id'))
         ->get();

        // Cargar la vista 'vet.diagnostico-nuevo' y pasar los diagnósticos pasados
        return view('vet.diagnostico-nuevo', compact('histories'));
    }



}
