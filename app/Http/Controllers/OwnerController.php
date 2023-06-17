<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $owners = Owner::where('estado', true)
    ->orderByDesc('created_at')
    ->paginate(7);
    return view('owner.dashboard')->with('owners', $owners);
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $owners=Owner::all();
        return view('owner.owners-nuevos')->with('owners', $owners);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
                 // Validando los datos del formulario
    $validatedData = $request->validate([
        'name' => 'required',
        'age' => 'required',
        'dui' => 'required',
        'phone' => 'required',
    ]);

    // Creando el nuevo user con los datos proporcionados
    $onwer = new Owner();
    $onwer->name = $request->input('name');
    $onwer->age = $request->input('age');
    $onwer->dui = $request->input('dui');
    $onwer->phone = $request->input('phone');
    $onwer->save();

    return redirect()->route('owner.dashboard')->with('success', 'Nuevo cliente creado exitosamente.');

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
        $owner = Owner::find($id);
        return view('owner.owners-editar', compact('owner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

    // actualizando el user
    $owner = Owner::find($id);
    $owner->name = $request->input('name');
    $owner->age = $request->input('age');
    $owner->dui = $request->input('dui');
    $owner->phone = $request->input('phone');
    $owner->save();

    return redirect()->route('owner.dashboard')->with('success', 'Cliente actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $owner = Owner::find($id);
        if ($owner) {
            $owner->estado = false;
            $owner->save();
            $owner->pets()->update(['estado' => false]);
        }
        return redirect('/owner/dashboard');
    }
}
