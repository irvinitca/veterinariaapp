<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Pet;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AppointmentsController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('Administrador')) {
            return view('admin.dashboard');
        } elseif ($user->hasRole('Recepcion')) {

            $appointments = Appointment::where('status','Activo')->orderBy('date_start')->paginate(10);


            $currentDateTime = Carbon::now();
            $appointments = Appointment::where('status','Activo')
            ->where('date_start', '>=', $currentDateTime->startOfHour()->toDateString())
            ->orderBy('date_start')->paginate(10);

            return view('recepcion.dashboard', compact('appointments'));
        }elseif ($user->hasRole('Veterinario')) {
            $appointments = Appointment::where('status', 'Activo')
                ->where('user_id', $user->id)
                ->orderBy('date_start')
                ->paginate(10);
            return view('vet.dashboard', compact('appointments'));
        }
         else {
            return view('dashboard');
        }

    }
    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id);
        $pets = Pet::where('estado', 1)->get();
        $users = User::whereHas('roles', function($q) {
            $q->where('name', 'Veterinario');
        })->get();
    
        return view('recepcion.edicion-citas', compact('appointment', 'pets', 'users'));
    }
    public function updatex(Request $request, $id)
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

    // Obtener la cita existente de la base de datos
    $appointment = Appointment::findOrFail($id);

    // Actualizar los campos de la cita con los datos validados
    $appointment->pet_id = $request->input('pet_id');
    $appointment->user_id = $request->input('user_id');
    $appointment->date_start = $request->input('date_start');
    $appointment->reason = $request->input('reason');
    $appointment->type = $request->input('type');

    $dateStart = Carbon::parse($request->input('date_start'));
    $dateEnd = $dateStart->addMinutes(30);
    $appointment->date_end = $dateEnd;

    if ($request->has('user_id')) {
        // Validar que no exista otra cita dentro del rango date_start y date_end para el usuario
        $existingAppointment = Appointment::where('user_id', $appointment->user_id)
            ->where('id', '!=', $appointment->id)
            ->where(function ($query) use ($dateStart, $dateEnd) {
                $query->whereBetween('date_start', [$dateStart, $dateEnd])
                    ->orWhereBetween('date_end', [$dateStart, $dateEnd])
                    ->orWhere(function ($query) use ($dateStart, $dateEnd) {
                        $query->where('date_start', '<=', $dateStart)
                            ->where('date_end', '>=', $dateEnd);
                    });
            })
            ->first();

        if ($existingAppointment) {
            // Existe otra cita dentro del rango date_start y date_end para el usuario
            // Puedes manejar el caso de error como desees, por ejemplo, lanzando una excepción o mostrando un mensaje de error al usuario.
            return back()->with('error', 'Ya existe una cita dentro del rango de fechas especificado para este usuario.');
        }
    }

    $appointment->save();

    // Redireccionar a la vista de lista de citas con un mensaje de éxito
    return redirect()->route('citas')->with('success', 'La cita ha sido actualizada exitosamente.');
}

    public function create($pet_id = null)
    {
        $pets = ($pet_id)
        ? Pet::where('id', $pet_id)
            ->where('estado', 1)
            ->get()
        : Pet::where('estado', 1)
            ->get();
        $users = User::whereHas(
            'roles', function($q){
                $q->where('name', 'Veterinario');
            }
        )->get();

        return view('recepcion.creacion-citas', compact('pets', 'users'));
    }
    public function pago($appointmentId){

        $appointment = Appointment::find($appointmentId);
        return view('recepcion.pago',compact('appointment'));
    }
    public function pagos()
    {
    
        $appointments = Appointment::where('status','Pagado')->orderBy('date_start')->paginate(10);


        return view('recepcion.pagos', compact('appointments'));
    }
    public function diagnosticadas()
    {
    
        $appointments = Appointment::where('status','Diagnosticada')->orderBy('date_start')->paginate(10);


        return view('recepcion.citas-diagnosticadas', compact('appointments'));
    }
    
    public function cancel($appointmentId)
    {
        $appointment = Appointment::find($appointmentId);

        if ($appointment) {
            $appointment->status = 'Cancelado';
            $appointment->save();

            return response()->json(['message' => 'La cita ha sido cancelada exitosamente.']);
        } else {
            return response()->json(['error' => 'No se encontró la cita especificada.'], 404);
        }
    }
    public function update($appointmentId)
    {
        $appointment = Appointment::find($appointmentId);

        if ($appointment) {
            $appointment->status = 'Pagado';
            $appointment->total = 0.00;
            $appointment->save();

            return response()->json(['message' => 'La cita ha sido pagado exitosamente.']);
        } else {
            return response()->json(['error' => 'No se encontró la cita especificada.'], 404);
        }
    }


    public function pay(Request $request)
    {
        // Validación de los datos enviados en el formulario
        $validatedData = $request->validate([
            'total' => 'required',
            'appointmentId'=>'required'
        ]);
        $appointment = Appointment::find($request->appointmentId);

        if ($appointment) {
            $appointment->status = 'Pagado';
            $appointment->cobrador_id =auth()->id();
            $appointment->total = $request->total;
            $appointment->date_payed=Carbon::now();
            $appointment->save();

            return redirect()->route('pagos')->with('success', 'La cita ha sido pagada exitosamente.(Puedes ver el registro en la tabla de citas pagadas)');
        } else {
           return back()->withInput()->withErrors(['msg' => "No existe una cita con ese id"]);
        }
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

        $dateStart = Carbon::parse($request->input('date_start'));
        $dateEnd = $dateStart->addMinutes(30);
        $appointment->date_end = $dateEnd;
        if ($request->has('user_id')) {
// Validar que no exista un appointment dentro del rango date_start y date_end para el usuario
$existingAppointment = Appointment::where('user_id', $appointment->user_id)
    ->where(function ($query) use ($dateStart, $dateEnd) {
        $query->whereBetween('date_start', [$dateStart, $dateEnd])
            ->orWhereBetween('date_end', [$dateStart, $dateEnd])
            ->orWhere(function ($query) use ($dateStart, $dateEnd) {
                $query->where('date_start', '<=', $dateStart)
                    ->where('date_end', '>=', $dateEnd);
            });
    })
    ->first();

if ($existingAppointment) {
    // Existe un appointment dentro del rango date_start y date_end para el usuario
    // Puedes manejar el caso de error como desees, por ejemplo, lanzando una excepción o mostrando un mensaje de error al usuario.
    return back()->with('error', 'Ya existe una cita dentro del rango de fechas especificado para este usuario.');

}
        }
        $appointment->save();

        // Redireccionar a la vista de lista de citas con un mensaje de éxito
        return redirect()->route('citas')->with('success', 'La cita ha sido creada exitosamente.');
    }
        //este metodo cierra la cita el Vet cuando la termina
        public function updateStatus($id)
        {
            $appointment = Appointment::find($id);

            if ($appointment) {
                $appointment->status = 'Cancelado';
                $appointment->save();

                return redirect()->route('vet.dashboard')->with('success', 'Se ha "Cancelado" la consulta exitosamente.');
            }

            return redirect()->route('vet.dashboard')->with('error', 'No se encontró la cita especificada.');
        }

}
