<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SedeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sedes = \App\Models\Sede::all();
        return view('sedes.index', compact('sedes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sedes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre_sede' => 'required|string|max:255',
            'ciudad' => 'nullable|string|max:255',
            'departamento' => 'nullable|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:255',
            'logo_url' => 'nullable|string|max:255',
        ]);

        \App\Models\Sede::create($request->all());

        return redirect()->route('sedes.index')->with('success', 'Sede creada exitosamente.');
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
        $sede = \App\Models\Sede::findOrFail($id);
        return view('sedes.edit', compact('sede'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $sede = \App\Models\Sede::findOrFail($id);

        $request->validate([
            'nombre_sede' => 'required|string|max:255',
            'ciudad' => 'nullable|string|max:255',
            'departamento' => 'nullable|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:255',
            'logo_url' => 'nullable|string|max:255',
        ]);

        $sede->update($request->all());

        return redirect()->route('sedes.index')->with('success', 'Sede actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sede = \App\Models\Sede::findOrFail($id);
        $sede->delete();

        return redirect()->route('sedes.index')->with('success', 'Sede eliminada exitosamente.');
    }
}
