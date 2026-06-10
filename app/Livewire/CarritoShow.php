<?php

namespace App\Livewire;

use App\Models\CarritoItem;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

class CarritoShow extends Component
{
    #[Layout('layouts.app')]

    public $cartItems;
    public $total = 0;

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $this->cartItems = CarritoItem::where('user_id', Auth::id())
            ->with([
                'producto' => function ($query) {
                    $query->with('categoria');
                },
                'tiendaRecogida' // Esta relación ahora existe después de actualizar el modelo
            ])
            ->get();

        $this->total = $this->cartItems->sum(function ($item) {
            if ($item->producto) {
                return $item->producto->precio * $item->cantidad;
            }
            return 0;
        });
    }

    public function incrementQuantity($itemId)
    {
        if (!Auth::check()) return;

        $item = CarritoItem::find($itemId);
        if ($item && $item->user_id === Auth::id()) {
            $item->increment('cantidad');
            $this->loadCart();
        }
    }

    public function decrementQuantity($itemId)
    {
        if (!Auth::check()) return;

        $item = CarritoItem::find($itemId);
        if ($item && $item->user_id === Auth::id()) {
            if ($item->cantidad > 1) {
                $item->decrement('cantidad');
            } else {
                $item->delete();
            }
            $this->loadCart();
        }
    }

    public function removeItem($itemId)
    {
        if (!Auth::check()) return;

        $item = CarritoItem::find($itemId);
        if ($item && $item->user_id === Auth::id()) {
            $item->delete();
            $this->loadCart();
        }
    }

    public function clearCart()
    {
        if (Auth::check()) {
            CarritoItem::where('user_id', Auth::id())->delete();
            $this->loadCart();
        }
    }

    public function irAPagar()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Verificar que haya items en el carrito
        if ($this->cartItems->isEmpty()) {
            session()->flash('error', 'Tu carrito está vacío');
            return;
        }

        // Verificar que todos los items tengan un método de entrega
        foreach ($this->cartItems as $item) {
            if (!$item->metodo_entrega_carrito) {
                session()->flash('error', 'Todos los productos deben tener un método de entrega seleccionado');
                return;
            }
        }

        return redirect()->route('checkout');
    }

    public function render()
    {
        return view('livewire.carrito-show');
    }
}
