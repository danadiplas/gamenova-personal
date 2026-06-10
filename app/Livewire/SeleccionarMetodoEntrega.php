<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Producto;
use App\Models\CarritoItem;
use App\Models\StockTienda;
use Illuminate\Support\Facades\Auth;

class SeleccionarMetodoEntrega extends Component
{
    #[Layout('layouts.app')]

    public $producto;
    public $cantidad = 1;
    public $metodoSeleccionado = null;
    public $tiendaSeleccionada = null;

    // Stock disponible
    public $stockDigital = 0;
    public $stockDomicilio = 0;
    public $stockTiendas = [];

    public function mount($productoId)
    {
        $this->producto = Producto::with('categoria')->findOrFail($productoId);

        // Cargar stock
        $this->cargarStock();
    }

    private function cargarStock()
    {
        // Stock digital (siempre disponible para todos los productos)
        $this->stockDigital = 999; // Stock ilimitado para formato digital

        // Stock para envío a domicilio
        $this->stockDomicilio = $this->producto->stock_online ?? 0;

        // Stock por tienda
        $this->stockTiendas = StockTienda::with('tienda')
            ->where('producto_id', $this->producto->id)
            ->where('cantidad', '>', 0)
            ->get()
            ->map(function ($stock) {
                return [
                    'tienda_id' => $stock->tienda_id,
                    'nombre' => $stock->tienda->nombre ?? 'Tienda',
                    'direccion' => $stock->tienda->direccion ?? '',
                    'ciudad' => $stock->tienda->ciudad ?? '',
                    'stock' => $stock->cantidad,
                    'ubicacion' => $stock->ubicacion ?? 'Sección General'
                ];
            })
            ->toArray();
    }

    public function increment()
    {
        $this->cantidad++;
    }

    public function decrement()
    {
        if ($this->cantidad > 1) {
            $this->cantidad--;
        }
    }

    public function seleccionarMetodo($metodo, $tiendaId = null)
    {
        $this->metodoSeleccionado = $metodo;
        $this->tiendaSeleccionada = $tiendaId;
    }

    public function agregarAlCarrito()
    {
        if (!Auth::check()) {
            session()->flash('error', 'Debes iniciar sesión para añadir productos al carrito');
            return redirect()->route('login');
        }

        if (!$this->metodoSeleccionado) {
            session()->flash('error', 'Debes seleccionar un método de entrega');
            return;
        }

        // Validaciones de stock
        if ($this->metodoSeleccionado === 'domicilio' && $this->stockDomicilio < $this->cantidad) {
            session()->flash('error', 'No hay suficiente stock disponible para envío a domicilio');
            return;
        }

        if ($this->metodoSeleccionado === 'recogida' && $this->tiendaSeleccionada) {
            $stockTienda = collect($this->stockTiendas)->firstWhere('tienda_id', $this->tiendaSeleccionada);
            if (!$stockTienda || $stockTienda['stock'] < $this->cantidad) {
                session()->flash('error', 'No hay suficiente stock en esta tienda');
                return;
            }
        }

        // Agregar al carrito
        CarritoItem::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'producto_id' => $this->producto->id,
            ],
            [
                'cantidad' => $this->cantidad,
                'metodo_entrega_carrito' => $this->metodoSeleccionado,
                'tienda_recogida_id' => ($this->metodoSeleccionado === 'recogida' && $this->tiendaSeleccionada) ? $this->tiendaSeleccionada : null,
            ]
        );

        session()->flash('success', 'Producto añadido al carrito correctamente');

        // Emitir evento para actualizar contador del carrito
        $this->dispatch('carrito-actualizado');

        // Redirigir al carrito
        return redirect()->route('carrito');
    }

    public function render()
    {
        return view('livewire.seleccionar-metodo-entrega');
    }
}
