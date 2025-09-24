<?php

namespace App\Http\Controllers;

use App\Http\Requests\JornadaRequest;
use App\Models\Jornada;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class JornadaController extends Controller
{
    public function index(): View
    {
        return view('jornadas.index');
    }

    public function getData(Request $request)
{
    if ($request->ajax()) {
        $jornadas = Jornada::select([
            'jornada_id',
            'nombre_jornada',
            'created_at',
            'updated_at'
        ])->get();

        $data = [];
        foreach ($jornadas as $jornada) {
            $data[] = [
                'jornada_id' => $jornada->jornada_id,
                'nombre_jornada' => $jornada->nombre_jornada,
                'fichas_count' => 0, // Por ahora 0, se puede conectar después
                'usuarios_count' => 0, // Por ahora 0, se puede conectar después
                'created_at' => $jornada->created_at ? $jornada->created_at->format('d/m/Y H:i') : 'N/A',
                'acciones' => '
                    <button onclick="editarJornada(' . $jornada->jornada_id . ')" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-3 rounded text-sm mr-2">
                        ✏️ Editar
                    </button>
                    <button onclick="eliminarJornada(' . $jornada->jornada_id . ')" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded text-sm">
                        🗑️ Eliminar
                    </button>
                '
            ];
        }

        return response()->json([
            'data' => $data
        ]);
    }
    
    return response()->json(['error' => 'Solicitud no válida'], 400);
}

    public function store(JornadaRequest $request): JsonResponse
    {
        try {
            $jornada = Jornada::create($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Jornada creada exitosamente',
                'data' => $jornada
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear la jornada: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show(Jornada $jornada): JsonResponse
    {
        $jornada->load(['fichas', 'usuarios']);
        
        return response()->json([
            'success' => true,
            'data' => $jornada
        ]);
    }

    public function update(JornadaRequest $request, Jornada $jornada): JsonResponse
    {
        try {
            $jornada->update($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Jornada actualizada exitosamente',
                'data' => $jornada
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar la jornada: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Jornada $jornada): JsonResponse
    {
        try {
            if ($jornada->hasFichas()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se puede eliminar la jornada porque tiene fichas asociadas'
                ], 400);
            }

            $jornada->delete();

            return response()->json([
                'success' => true,
                'message' => 'Jornada eliminada exitosamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar la jornada: ' . $e->getMessage()
            ], 500);
        }
    }
}