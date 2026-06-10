<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();

        $productos = Producto::with([
            'categoria',
            'stock',
            'stockTiendas'
        ])->get();

        return view('listadoProductos', compact('productos'), ['categorias' => $categorias]);
    }

    public function filter(Request $request)
    {

        $productos = Producto::with('categoria')
            ->when($request->categoria_id, function ($query) use ($request) {
                $query->where('categoria_id', $request->categoria_id);
            })
            ->get();

        return view('partials.product-card', compact('productos'))->render();
    }

    public function verProducto(Request $request)
    {
        $producto = Producto::with('categoria')->where('id', $request->id)->get();
        return view('producto', compact('producto'));
    }
}
