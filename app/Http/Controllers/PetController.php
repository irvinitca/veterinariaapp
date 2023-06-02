<?php

namespace App\Http\Controllers;
use App\Models\Pet;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Owner;
use App\Models\Type;
use App\Models\Breed;


class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pets = Pet::where('estado', true)->orderByDesc('created_at')->paginate(7);
    return view('pet.dashboard')->with('pets', $pets);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        $breeds = Breed::all();
        $owners = Owner::where('estado', 1)->get();
        $pets = Pet::all();
        return view('pet.pets-nuevos', compact('pets', 'owners','types', 'breeds'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validar los datos del formulario
    $validatedData = $request->validate([
        'name' => 'required',
        'weight' => 'required',
        'selectedType' => 'required',
        'selectedBreed' => 'required',
        'age' => 'required',
        'owner_id' => 'required',
    ]);

    // Crear la instancia de Pet y establecer los valores
    $pet = new Pet();
    $pet->name = $request->input('name');
    $pet->weight = $request->input('weight');
    $pet->age = $request->input('age');
    $pet->owner_id = $request->input('owner_id');
    $pet->type = $request->input('selectedType');
    $pet->breed = $request->input('selectedBreed');

    // Guardar la mascota
    $pet->save();

    return redirect()->route('pet.dashboard')->with('success', 'Nueva mascota creada exitosamente.');
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
        $pet = Pet::find($id);
        $pet->estado=false;
        $pet->save();

        return redirect('/pet/dashboard');
    }
}
