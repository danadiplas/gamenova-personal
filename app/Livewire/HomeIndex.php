<?php

namespace App\Livewire;

use App\Models\Producto;
use App\Models\CarritoItem;
use App\Models\Categoria;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class HomeIndex extends Component
{
    #[Layout('layouts.app')]

    public $categoria_id = null; // Nueva propiedad para filtrar

    // Esto captura el parámetro de la URL
    public function mount($categoria = null)
    {
        if ($categoria) {
            $this->categoria_id = $categoria;
        }
    }

    public function render()
    {
        // Construir la consulta base
        $query = Producto::where('activo', true)
            ->with('categoria')
            ->orderBy('destacado', 'desc')
            ->orderBy('created_at', 'desc');

        // Aplicar filtro de categoría si existe
        if ($this->categoria_id) {
            $query->where('categoria_id', $this->categoria_id);
        }

        // Obtener productos
        $productos = $query->take(12)->get();

        $categorias = Categoria::where('activa', true)->get();

        // Obtener categoría actual para mostrar nombre
        $categoriaActual = $this->categoria_id
            ? Categoria::find($this->categoria_id)
            : null;

        return view('livewire.home-index', [
            'productos' => $productos,
            'categorias' => $categorias,
            'categoriaActual' => $categoriaActual,
        ]);
    }

    // Método para limpiar filtros
    public function limpiarFiltros()
    {
        $this->categoria_id = null;
    }

    // Método para añadir producto al carrito
    public function agregarAlCarrito($productoId)
    {
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            session()->flash('error', 'Debes iniciar sesión para añadir productos al carrito');
            return redirect()->route('login');
        }

        // Verificar si el producto existe
        $producto = Producto::find($productoId);

        if (!$producto) {
            session()->flash('error', 'Producto no encontrado');
            return;
        }

        // Redirigir a la página de selección de método de entrega
        return redirect()->route('seleccionar-metodo-entrega', ['productoId' => $productoId]);
    }

    // Método opcional para obtener la cantidad en el carrito
    public function getCantidadEnCarrito($productoId)
    {
        if (!Auth::check()) {
            return 0;
        }

        $item = CarritoItem::where('user_id', Auth::id())
            ->where('producto_id', $productoId)
            ->first();

        return $item ? $item->cantidad : 0;
    }
}
