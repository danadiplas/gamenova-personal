<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CarritoItem;
use Illuminate\Support\Facades\Auth;

class AgregarAlCarrito extends Component
{
    public $producto;
    public $enCarrito = false;
    public $metodoEntrega = null;

    public function mount($producto)
    {
        $this->producto = $producto;

        if (Auth::check()) {
            $item = CarritoItem::where('user_id', Auth::id())
                ->where('producto_id', $this->producto->id)
                ->first();

            $this->enCarrito = $item ? true : false;
            $this->metodoEntrega = $item ? $item->metodo_entrega : null;
        }
    }

    public function agregarAlCarrito()
    {
        if (!Auth::check()) {
            session()->flash('error', 'Debes iniciar sesión para añadir productos al carrito');
            return redirect()->route('login');
        }

        // Redirigir a la página de selección de método de entrega
        return redirect()->route('seleccionar-metodo-entrega', ['productoId' => $this->producto->id]);
    }

    public function render()
    {
        return view('livewire.agregar-al-carrito');
    }
}
