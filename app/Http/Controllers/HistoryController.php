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
use Illuminate\Support\Facades\DB;

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
        $petId = $request->input('pet_id');
        // diagnósticos del paciente
        $histories = History::whereHas('appointment', function ($query) use ($petId) {
            $query->whereHas('pet', function ($query) use ($petId) {
                $query->where('id', $petId);
            });
        })->get();

        return view('vet.diagnostico-nuevo', compact('histories'));
        }
         else {
            return view('dashboard');
        }

    }


            public function showForm(Request $request, $appointment_id)
            {
                // Obteniendo el ID del paciente autenticado
                $userId = Auth::id();
                $appointment = Appointment::findOrFail($appointment_id);

                // todas las citas del paciente, independientemente de su estado
                $appointments = Appointment::where('user_id', $userId)
                ->with('pet') // Cargar la relación de mascota junto con las citas
                ->get();

                // Diagnósticos(historail) del Paciente elegido, todos los Vets tambien,
                $histories = History::whereHas('appointment', function ($query) use ($appointment) {
                    $query->where('pet_id', $appointment->pet_id);
                })
                ->with('appointment.pet', 'appointment.user')
                ->orderByDesc('id')
                ->get();


                // Cargando la vista del formulario de diagnóstico y pasar las citas disponibles y los diagnósticos
                return view('vet.diagnostico-nuevo', compact('appointments', 'histories', 'appointment'));
            }

        public function create(Request $request)
        {
            $validatedData = $request->validate([
                'appointment_id' => 'required|exists:appointments,id',
                'date_resolved' => 'required|date',
                'diagnostic' => 'required',
                'services' => 'required',
                'indications' => 'required',
                'medicaments' => 'required',
            ]);
            $history = new History;
            $history->appointment_id = $request->appointment_id;
            $history->date_resolved = $request->date_resolved;
            $history->diagnostic = $request->diagnostic;
            $history->services = $request->services;
            $history->indications = $request->indications;
            $history->medicaments = $request->medicaments;
            $history->save();
            $appointment = Appointment::findOrFail($request->appointment_id);
            $appointment->status = 'Diagnosticada';
            $appointment->save();
            return redirect()->route('vet.diagnostico-nuevo')->with('success', 'Diagnóstico creado exitosamente');
        }

        public function history($pet)
{
   
    $history = History::whereHas('appointment', function ($query) use ($pet) {
        $query->where('pet_id', $pet);
    })->get();
    return response()->json($history);
}
        public function histories(){
            $user_id = auth()->id();
            $appointments = DB::table('appointments')
            ->join('pets', 'appointments.pet_id', '=', 'pets.id')
            ->join('users', 'pets.owner_id', '=', 'users.id')
            ->where('appointments.user_id', '=', $user_id)
            ->selectRaw('pets.id, pets.name, users.name as owner_name')
            ->groupBy('pets.id', 'pets.name', 'users.name')
            ->paginate(10);
        

            return view('pet.histories', compact('appointments'));
        }
                public function store(Request $request)
        {
            $validatedData = $request->validate([
                'appointment_id' => 'required|exists:appointments,id',
                'date_resolved' => 'required|date',
                'diagnostic' => 'required',
                'services' => 'required',
                'indications' => 'required',
                'medicaments' => 'required',
            ]);

            $history = new History;
            $history->appointment_id = $request->appointment_id;
            $history->date_resolved = $request->date_resolved;
            $history->diagnostic = $request->diagnostic;
            $history->services = $request->services;
            $history->indications = $request->indications;
            $history->medicaments = $request->medicaments;
            $history->save();
            $appointment = Appointment::findOrFail($request->appointment_id);
            $appointment->status = 'Diagnosticada';
            $appointment->save();

            return redirect()->route('vet.diagnostico-nuevo', ['appointment_id' => $history->appointment_id])->with('success', 'Diagnóstico creado exitosamente');

        }

             public function showDetails($id)
        {

            // Obtener los datos del diagnóstico por el ID
            $history = History::where('appointment_id', $id)->firstOrFail();


            // Retornar una respuesta JSON con los datos del diagnóstico
            return response()->json($history);
        }
}
