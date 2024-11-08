<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Inventario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class inventarioController extends Controller
{
    // Función para obtener todos los inventarios
    public function index()
    {
        $inventarios = Inventario::all();

        if ($inventarios->isEmpty()) {
            return response()->json(['message' => 'No hay productos registrados'], 404);
        }

        return response()->json($inventarios, 200);
    }

    // Función para crear un nuevo inventario
    public function store(Request $request)
    {
        // Validación de los datos recibidos en la solicitud
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:255',
            'precio' => 'required|numeric'  // Cambié 'digits:10' a 'numeric', porque 'digits:10' no es adecuado para precios.
        ]);

        // Si la validación falla, devolver un mensaje de error
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        // Crear el nuevo inventario
        $inventario = Inventario::create([
            'nombre' => $request->nombre,
            'precio' => $request->precio
        ]);

        // Si ocurrió un error al guardar, devolver un error 500
        if (!$inventario) {
            return response()->json([
                'message' => 'Error al crear producto',
                'status' => 500
            ], 500);
        }

        // Si la creación fue exitosa, devolver el inventario creado con el estado 201
        return response()->json([
            'inventario' => $inventario,
            'status' => 201
        ], 201);
    }
}

