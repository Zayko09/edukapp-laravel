<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all();
        return view('dashboard.index', compact('usuarios'));
    }

    public function showCarnet(Usuario $usuario)
    {
        $qrData = json_encode([
            'id' => $usuario->usuario_id,
            'nombre' => $usuario->nombre . ' ' . $usuario->apellido,
            'email' => $usuario->email,
            'documento' => $usuario->numero_documento
        ]);

        $qrCodeUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=' . urlencode($qrData);

        return view('dashboard.carnet', compact('usuario', 'qrCodeUrl'));
    }
}
