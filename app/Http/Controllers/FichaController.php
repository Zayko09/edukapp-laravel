<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ficha;
use Illuminate\Http\Request;

class FichaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('fichas.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('fichas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'sede_id' => ['required', 'integer', 'exists:sedes,sede_id'],
        ]);

        Ficha::create([
            'nombre' => $request->nombre,
            'sede_id' => $request->sede_id,
        ]);

        return redirect()->route('fichas.index')->with('success', 'Ficha creada correctamente.');
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
