<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Pet;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->hasRole('Administrador')) {
            return view('admin.dashboard');
        } elseif ($user->hasRole('Recepcion')) {
            $appointments = Appointment::orderByDesc('date_start')->paginate(10);
            return view('recepcion.dashboard', compact('appointments'));
        }elseif ($user->hasRole('Veterinario')) {
            return view('veterinario.dashboard');
        }
         else {
            return view('dashboard');
        }

    }
    public function create()
    {
        $pets = Pet::all();
        $users = User::whereHas(
            'roles', function($q){
                $q->where('name', 'Veterinario');
            }
        )->get();

        return view('recepcion.creacion-citas', compact('pets', 'users'));
    }

    public function store(Request $request)
    {
        // Validación de los datos enviados en el formulario
        $validatedData = $request->validate([
            'pet_id' => 'required',
            'user_id' => 'nullable',
            'status' => 'nullable',
            'date_start' => 'required|date',
            'date_end' => 'nullable|date',
            'reason' => 'required',
            'type' => 'required',
        ]);

        // Crear una nueva cita con los datos validados
        $appointment = new Appointment();
        $appointment->pet_id = $request->input('pet_id');
        $appointment->user_id = $request->input('user_id');
        $appointment->status = 'Activo';
        $appointment->date_start = $request->input('date_start');
        $appointment->reason = $request->input('reason');
        $appointment->type = $request->input('type');
        $appointment->save();

        // Redireccionar a la vista de lista de citas con un mensaje de éxito
        return redirect()->route('citas')->with('success', 'La cita ha sido creada exitosamente.');
    }

}
