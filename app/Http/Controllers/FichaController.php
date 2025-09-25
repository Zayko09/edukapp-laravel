<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ficha;
use App\Models\Sede; // Import Sede model
use App\Models\Jornada; // Import Jornada model
use App\Http\Requests\FichaRequest; // Import FichaRequest
use Illuminate\Http\Request;

class FichaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fichas = Ficha::all();
        return view('fichas.index', compact('fichas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sedes = Sede::all();
        $jornadas = Jornada::all();
        return view('fichas.create', compact('sedes', 'jornadas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FichaRequest $request) // Use FichaRequest for validation
    {
        Ficha::create($request->validated()); // Use validated data

        return redirect()->route('fichas.index')->with('success', 'Ficha creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ficha = Ficha::findOrFail($id);
        return view('fichas.show', compact('ficha'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ficha = Ficha::findOrFail($id);
        $sedes = Sede::all();
        $jornadas = Jornada::all();
        return view('fichas.edit', compact('ficha', 'sedes', 'jornadas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FichaRequest $request, string $id) // Use FichaRequest for validation
    {
        $ficha = Ficha::findOrFail($id);
        $ficha->update($request->validated()); // Use validated data

        return redirect()->route('fichas.index')->with('success', 'Ficha actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ficha = Ficha::findOrFail($id);
        $ficha->delete();

        return redirect()->route('fichas.index')->with('success', 'Ficha eliminada exitosamente.');
    }
}