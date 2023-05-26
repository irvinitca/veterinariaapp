<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rule;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->hasRole('Administrador')) {
            $users = User::with('roles')->orderByDesc('created_at')->paginate(10);
            return view('admin.dashboard', compact('users'));
        } elseif ($user->hasRole('Recepcion')) {
            $appointments = Appointment::orderByDesc('date_start')->paginate(10);
            return view('recepcion.dashboard', compact('appointments'));
        }elseif ($user->hasRole('Veterinario')) {
            return view('vet.dashboard');
        }
         else {
            return view('dashboard');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.usuarios-nuevos', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            // Validando los datos del formulario
    $validatedData = $request->validate([
        'name' => 'required',
        'email' => [
            'required',
            'email',
            Rule::unique('users'),
        ],
        'password' => 'required',
        'password' => 'required|confirmed',
        'role_id' => 'required',
    ]);

    // Creando el nuevo user con los datos proporcionados
    $user = new User();
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->password = bcrypt($request->input('password'));
    $user->save();

    // Asigna el rol al nuevo usuario
    $role = Role::findOrFail($request->input('role_id'));
    $user->assignRole($role);

    return redirect()->route('admin.dashboard')->with('success', 'Nuevo usuario creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
