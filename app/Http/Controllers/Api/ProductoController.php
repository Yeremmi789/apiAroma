<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categorias;
use App\Models\Productos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    public function mostrarCategorias(Request $request)
    {

        $categorias = Categorias::all();
        return response()->json(
            $categorias
        );
    }

    public function mostrarProductos()
    {
        // $productos = Productos::all();
        // $productos = DB::table('productos')
        $productos = Productos::join('categoria', 'productos.categoria_id', '=', 'categoria.id')
            ->select('productos.*', 'categoria.etiqueta as categoria')
            ->get();

        foreach ($productos as $producto) {
            $producto->img = asset($producto->img);
        }

        // Establecer el encabezado Content-Type
        header('Content-Type: application/json');
        return response()->json(
            $productos
        )->header('Content-Type', 'application/json');
        // return response()->json($productos)->header('Content-Type', 'application/json');

    }

    public function buscarProduc($id)
    {
        // $paciente = Productos::all()->where('id', $id)->first();

        // $productos = Productos::join('categoria', 'productos.categoria_id', '=', 'categoria.id')
        //     ->select('productos.*', 'categoria.etiqueta as name')->where('id', $id)->first();

        $productos = Productos::join('categoria', 'productos.categoria_id', '=', 'categoria.id')
            ->select('productos.*', 'categoria.etiqueta as categoria')
            ->where('productos.id', $id)
            ->first();

        // foreach ($productos as $producto) {
        //     $producto->img = asset($producto->img);
        // }

        // return response()->json($productos);
        header('Content-Type: application/json');
        return response()->json($productos)->header('Content-Type', 'application/json');
    }
}
