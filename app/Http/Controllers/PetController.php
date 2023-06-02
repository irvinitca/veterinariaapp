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
        $pets = Pet::where('estado', true)
        ->orderByDesc('created_at')
        ->paginate(7);
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
    //dd($request->all());
    // Validar los datos del formulario
    $validatedData = $request->validate([
        'name' => 'required',
        'weight' => 'required',
        'selectedType' => 'required',
        'selectedBreed' => 'required',
        'age' => 'required',
        'owner_id' => 'required',
    ]);

    // Obtener los nombres de tipo y raza seleccionados
    $selectedType = Type::find($request->input('selectedType'))->name;
    $selectedBreed = Breed::find($request->input('selectedBreed'))->name;

    // Crear la instancia de Pet y establecer los valores
    $pet = new Pet();
    $pet->name = $request->input('name');
    $pet->weight = $request->input('weight');
    $pet->age = $request->input('age');
    $pet->owner_id = $request->input('owner_id');
    $pet->type = $selectedType;
    $pet->breed = $selectedBreed;

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
    public function edit($id)
    {
        $pet = Pet::find($id);
        $types = Type::all();
        $breeds = Breed::all();
        $owners = Owner::all();
        return view('pet.pets-editar', compact('pet', 'types', 'breeds', 'owners'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {


    $selectedType = Type::find($request->input('selectedType'))->name;
    $selectedBreed = Breed::find($request->input('selectedBreed'))->name;

    // Crear la instancia de Pet y establecer los valores
    $pet = Pet::find($id);
    $pet->name = $request->input('name');
    $pet->weight = $request->input('weight');
    $pet->age = $request->input('age');
    $pet->owner_id = $request->input('owner_id');
    $pet->type = $selectedType;
    $pet->breed = $selectedBreed;

    // Guardar la mascota
    $pet->save();

    return redirect()->route('pet.dashboard')->with('success', 'Mascota actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pet = Pet::find($id);
        $pet->estado=false;
        $pet->save();

        return redirect('/pet/dashboard');
    }
}
