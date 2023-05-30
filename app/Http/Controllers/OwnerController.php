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
    $owners = Owner::orderBy('created_at')->paginate(10);
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
