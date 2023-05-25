<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->hasRole('Administrador')) {
            $users = User::orderByDesc('created_at')->paginate(10);

        foreach ($users as $user) {
            $user->role_name = DB::table('roles')->where('id', $user->role_id)->value('name');
        }
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
        $users = User::all();

        return view('admin.creacion-users');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
