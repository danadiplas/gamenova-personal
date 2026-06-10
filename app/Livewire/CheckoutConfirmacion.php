<?php

namespace App\Livewire;

use App\Models\Pedido;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

class CheckoutConfirmacion extends Component
{
    #[Layout('layouts.app')]

    public $pedidoId;
    public $pedido;

    public function mount($pedido)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $this->pedidoId = $pedido;
        $this->pedido = Pedido::with(['user', 'direccionEnvio', 'direccionFacturacion', 'ordenes.producto'])
            ->where('id', $this->pedidoId)
            ->where('user_id', Auth::id())
            ->firstOrFail();
    }

    public function imprimirFactura()
    {
        // Lógica para imprimir factura
        session()->flash('success', 'Preparando factura para imprimir...');
    }

    public function descargarFactura()
    {
        // Lógica para descargar factura
        session()->flash('success', 'Descargando factura...');
    }

    public function volverAlCatalogo()
    {
        return redirect()->route('catalogo');
    }

    public function render()
    {
        return view('livewire.checkout-confirmacion', [
            'pedido' => $this->pedido,
        ]);
    }
}
