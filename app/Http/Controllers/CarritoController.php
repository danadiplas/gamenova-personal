<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\CarritoItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarritoController extends Controller
{
    public function agregar(Request $request)
    {
        $validated = $request->validate([
            'producto_id' => 'required|exists:productos,id'
        ]);

        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Debes iniciar sesión.');
        }

        $producto = Producto::findOrFail($validated['producto_id']);

        // BUSCAR en BD (como hace CarritoShow)
        $carritoItem = CarritoItem::where('user_id', Auth::id())
            ->where('producto_id', $producto->id)
            ->first();

        if ($carritoItem) {
            $carritoItem->increment('cantidad');
        } else {
            CarritoItem::create([
                'user_id' => Auth::id(),
                'producto_id' => $producto->id,
                'cantidad' => 1,
                'metodo_entrega_carrito' => 'domicilio', // Valor por defecto
                'precio_carrito' => $producto->precio,
            ]);
        }

        return redirect()->route('seleccionar-metodo-entrega', $producto->id);
    }
}
