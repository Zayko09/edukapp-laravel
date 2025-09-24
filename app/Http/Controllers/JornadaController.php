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

    public function getData(Request $request): JsonResponse
    {
        if ($request->ajax()) {
            $jornadas = Jornada::select([
                'jornada_id',
                'nombre_jornada',
                'created_at'
            ])->with(['fichas:jornada_id', 'usuarios:jornada_id']);

            return DataTables::of($jornadas)
                ->addColumn('fichas_count', function ($jornada) {
                    return $jornada->fichas->count();
                })
                ->addColumn('usuarios_count', function ($jornada) {
                    return $jornada->usuarios->count();
                })
                ->addColumn('acciones', function ($jornada) {
                    $canDelete = !$jornada->hasFichas();
                    
                    $editBtn = '<button class="btn btn-sm btn-warning me-1" 
                                    onclick="editJornada(' . $jornada->jornada_id . ')">
                                    <i class="fas fa-edit"></i>
                                </button>';
                    
                    $deleteBtn = $canDelete ? 
                        '<button class="btn btn-sm btn-danger" 
                                onclick="deleteJornada(' . $jornada->jornada_id . ')">
                                <i class="fas fa-trash"></i>
                            </button>' : 
                        '<button class="btn btn-sm btn-secondary" disabled>
                                <i class="fas fa-lock"></i>
                            </button>';
                    
                    return $editBtn . $deleteBtn;
                })
                ->editColumn('created_at', function ($jornada) {
                    return $jornada->created_at->format('d/m/Y H:i');
                })
                ->rawColumns(['acciones'])
                ->make(true);
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