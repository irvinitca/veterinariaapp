<?php

namespace App\Http\Controllers;
use App\Models\Pet;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pets = Pet::orderByDesc('created_at')->paginate(7);
    return view('pet.dashboard')->with('pets', $pets);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pets = Pet::all();
    return view('pet.pets-nuevos', compact('pets'));
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
