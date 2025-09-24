<?php

namespace App\Http\Controllers\Usuario;

use App\Models\Usuario;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = Usuario::all();
        return view('Usuario.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Usuario.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:usuarios'],
            'numero_documento' => ['required', 'string', 'max:255', 'unique:usuarios'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'activo' => ['required', 'boolean'],
            'sede_id' => ['required', 'integer', 'exists:sedes,sede_id'],
        ]);

        Usuario::create([
            'usuario_id' => random_int(100000, 999999), // Since incrementing is false
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'numero_documento' => $request->numero_documento,
            'hash_contrasena' => Hash::make($request->password),
            'salt_contrasena' => '' ,// Not needed with modern hashing
            'activo' => $request->activo,
            'fecha_creacion' => now(), // Since timestamps are false
            'sede_id' => $request->sede_id,
        ]);

        return redirect()->route('Usuario.index')->with('success', 'Usuario creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Usuario $usuario)
    {
        // Not used in this implementation
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Usuario $usuario)
    {
        return view('Usuario.edit', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Usuario $usuario)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:usuarios,email,' . $usuario->usuario_id . ',usuario_id'],
            'numero_documento' => ['required', 'string', 'max:255', 'unique:usuarios,numero_documento,' . $usuario->usuario_id . ',usuario_id'],
            'activo' => ['required', 'boolean'],
        ]);

        $usuario->update([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'numero_documento' => $request->numero_documento,
            'activo' => $request->activo,
        ]);

        return redirect()->route('Usuario.index')->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario)
    {
        $usuario->delete();
        return redirect()->route('Usuario.index')->with('success', 'Usuario eliminado correctamente.');
    }
}