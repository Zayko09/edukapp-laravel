<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Role;
use App\Models\Sede;
use App\Models\Jornada;
use App\Models\Ficha;
use App\Http\Requests\UsuarioRequest;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = Usuario::with(['role', 'sede', 'jornada', 'ficha'])->paginate(10);
        return view('Usuario.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        $sedes = Sede::all();
        $jornadas = Jornada::all();
        $fichas = Ficha::all();
        return view('Usuario.create', compact('roles', 'sedes', 'jornadas', 'fichas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UsuarioRequest $request)
    {
        // Validation logic will be added in a custom request class.
        $data = $request->all();
        // Password and salt handling should be implemented here.
        // For now, let's assume plain text password for simplicity, but this is insecure.
        $data['hash_contrasena'] = bcrypt($request->password); 
        $data['salt_contrasena'] = ''; // Salt is handled by bcrypt

        Usuario::create($data);

        return redirect()->route('Usuario.index')
                         ->with('success', 'Usuario created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Usuario $usuario)
    {
        return view('Usuario.show', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Usuario $usuario)
    {
        $roles = Role::all();
        $sedes = Sede::all();
        $jornadas = Jornada::all();
        $fichas = Ficha::all();
        return view('Usuario.edit', compact('usuario', 'roles', 'sedes', 'jornadas', 'fichas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UsuarioRequest $request, Usuario $usuario)
    {
        // Validation logic will be added in a custom request class.
        $data = $request->all();

        if ($request->filled('password')) {
            $data['hash_contrasena'] = bcrypt($request->password);
            $data['salt_contrasena'] = ''; // Salt is handled by bcrypt
        } else {
            unset($data['password']);
        }

        $usuario->update($data);

        return redirect()->route('Usuario.index')
                         ->with('success', 'Usuario updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario)
    {
        $usuario->delete();

        return redirect()->route('Usuario.index')
                         ->with('success', 'Usuario deleted successfully.');
    }
}
