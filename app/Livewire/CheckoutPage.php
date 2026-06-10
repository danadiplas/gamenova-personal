<?php

namespace App\Livewire;

use App\Models\CarritoItem;
use App\Models\Direccion;
use App\Models\Pedido;
use App\Models\OrdenPedido;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckoutPage extends Component
{
    #[Layout('layouts.app')]

    public $cartItems;
    public $total = 0;
    public $subtotal = 0;
    public $envio = 0;
    public $iva = 0;

    public $direccionEnvio;
    public $direccionFacturacion;
    public $metodoPago = 'tarjeta';

    // Datos del formulario
    public $nombre;
    public $apellidos;
    public $email;
    public $telefono;
    public $direccion;
    public $ciudad;
    public $provincia;
    public $codigoPostal;
    public $pais = 'España';

    // Tarjeta de crédito
    public $numeroTarjeta;
    public $nombreTitular;
    public $fechaExpiracion;
    public $cvv;
    public $recordarTarjeta = false;

    // Estados
    public $mismaDireccion = true;
    public $aceptaTerminos = false;

    protected $rules = [
        'nombre' => 'required|min:2',
        'apellidos' => 'required|min:2',
        'email' => 'required|email',
        'telefono' => 'required',
        'metodoPago' => 'required',
        'aceptaTerminos' => 'accepted',
    ];

    public function mount()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $this->cargarCarrito();
        $this->cargarDatosUsuario();
        $this->calcularTotales();
    }

    public function cargarCarrito()
    {
        $this->cartItems = CarritoItem::where('user_id', Auth::id())
            ->with(['producto' => function ($query) {
                $query->with('categoria');
            }])
            ->get();

        if ($this->cartItems->count() === 0) {
            session()->flash('error', 'Tu carrito está vacío');
            return redirect()->route('carrito');
        }
    }

    public function cargarDatosUsuario()
    {
        $user = Auth::user();

        $direccionPrincipal = Direccion::where('user_id', $user->id)
            ->where('es_principal', true)
            ->first();

        if ($direccionPrincipal) {
            $this->nombre = explode(' ', $user->name)[0] ?? '';
            $this->apellidos = implode(' ', array_slice(explode(' ', $user->name), 1));
            $this->email = $user->email;
            $this->direccion = $direccionPrincipal->direccion;
            $this->ciudad = $direccionPrincipal->ciudad;
            $this->provincia = $direccionPrincipal->provincia;
            $this->codigoPostal = $direccionPrincipal->codigo_postal;
            $this->pais = $direccionPrincipal->pais;
            $this->telefono = $direccionPrincipal->telefono;

            $this->direccionEnvio = $direccionPrincipal->id;
            $this->direccionFacturacion = $this->mismaDireccion ? $direccionPrincipal->id : null;
        } else {
            $this->nombre = explode(' ', $user->name)[0] ?? '';
            $this->apellidos = implode(' ', array_slice(explode(' ', $user->name), 1));
            $this->email = $user->email;
        }
    }

    public function calcularTotales()
    {
        if (!$this->cartItems || $this->cartItems->count() === 0) {
            $this->subtotal = 0;
            $this->envio = 0;
            $this->iva = 0;
            $this->total = 0;
            return;
        }

        $this->subtotal = $this->cartItems->sum(function ($item) {
            if ($item->producto) {
                return $item->producto->precio * $item->cantidad;
            }
            return 0;
        });

        $this->envio = 0;

        // Solo cobra envío si hay productos con envío a domicilio
        $itemsConEnvioDomicilio = $this->cartItems->filter(function ($item) {
            return $item->metodo_entrega === 'domicilio';
        });

        if ($itemsConEnvioDomicilio->count() > 0) {
            $subtotalEnvio = $itemsConEnvioDomicilio->sum(function ($item) {
                if ($item->producto) {
                    return $item->producto->precio * $item->cantidad;
                }
                return 0;
            });

            if ($subtotalEnvio <= 50) {
                $this->envio = 3.99;
            }
        }

        $this->iva = $this->subtotal * 0.21;
        $this->total = $this->subtotal + $this->envio + $this->iva;
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'mismaDireccion') {
            $this->calcularTotales();
        }
    }

    public function procesarPago()
    {
        // Validar solo lo esencial
        $this->validate([
            'nombre' => 'required|min:2',
            'apellidos' => 'required|min:2',
            'email' => 'required|email',
            'telefono' => 'required',
            'metodoPago' => 'required',
            'aceptaTerminos' => 'accepted',
        ]);

        if (!$this->cartItems || $this->cartItems->count() === 0) {
            session()->flash('error', 'Tu carrito está vacío');
            return redirect()->route('carrito');
        }

        try {
            DB::beginTransaction();

            $user = Auth::user();

            // Verificar si necesitamos dirección (solo si hay productos físicos)
            $necesitaDireccion = $this->cartItems->contains(function ($item) {
                return in_array($item->metodo_entrega, ['domicilio', 'recogida']);
            });

            $direccionEnvioId = null;
            $direccionFacturacionId = null;

            if ($necesitaDireccion) {
                // Validar campos de dirección solo si es necesario
                $this->validate([
                    'direccion' => 'required',
                    'ciudad' => 'required',
                    'provincia' => 'required',
                    'codigoPostal' => 'required',
                ]);

                // Crear o actualizar la dirección
                $direccionGuardada = Direccion::updateOrCreate(
                    [
                        'user_id' => $user->id,
                        'es_principal' => true,
                    ],
                    [
                        'tipo' => 'envio',
                        'nombre_direccion' => 'Dirección Principal',
                        'destinatario' => $this->nombre . ' ' . $this->apellidos,
                        'direccion' => $this->direccion,
                        'ciudad' => $this->ciudad,
                        'provincia' => $this->provincia,
                        'codigo_postal' => $this->codigoPostal,
                        'pais' => $this->pais,
                        'telefono' => $this->telefono,
                        'es_principal' => true,
                    ]
                );

                $direccionEnvioId = $direccionGuardada->id;
                $direccionFacturacionId = $this->mismaDireccion ? $direccionGuardada->id : null;
            }

            // Determinar el método de entrega principal
            $metodosEntrega = $this->cartItems->pluck('metodo_entrega')->countBy();
            $metodoMasComun = $metodosEntrega->sortDesc()->keys()->first();

            // Crear el pedido
            $pedido = new Pedido();
            $pedido->user_id = $user->id;
            $pedido->numero_pedido = 'GN-' . date('Ymd') . '-' . strtoupper(uniqid());
            $pedido->direccion_envio_id = $direccionEnvioId;
            $pedido->direccion_facturacion_id = $direccionFacturacionId;
            $pedido->subtotal = $this->subtotal;
            $pedido->envio = $this->envio;
            $pedido->iva = $this->iva;
            $pedido->total = $this->total;
            $pedido->estado = 'confirmado';
            $pedido->metodo_pago = $this->metodoPago;
            $pedido->metodo_entrega = $metodoMasComun;
            $pedido->fecha_pedido = now();
            $pedido->save();

            // Crear los items del pedido
            foreach ($this->cartItems as $item) {
                if ($item->producto) {
                    $orden = new OrdenPedido();
                    $orden->pedido_id = $pedido->id;
                    $orden->producto_id = $item->producto_id;
                    $orden->cantidad = $item->cantidad;
                    $orden->precio_unitario = $item->producto->precio;
                    $orden->subtotal = $item->producto->precio * $item->cantidad;
                    $orden->metodo_entrega = $item->metodo_entrega_carrito;

                    // Generar clave digital si el método es digital
                    if ($item->metodo_entrega_carrito === 'digital') {
                        $orden->clave_digital = $this->generarClaveDigital();
                        $orden->clave_generada_en = now();
                    }

                    $orden->save();

                    // Actualizar stock solo para productos físicos
                    if ($item->metodo_entrega_carrito !== 'digital') {
                        $producto = $item->producto;
                        $producto->stock_online = max(0, $producto->stock_online - $item->cantidad);
                        $producto->save();
                    }
                }
            }

            // Vaciar el carrito
            CarritoItem::where('user_id', $user->id)->delete();

            DB::commit();

            // Emitir evento de actualización
            $this->dispatch('carrito-actualizado');

            // Redirigir a confirmación
            return redirect()->route('checkout.confirmacion', ['pedido' => $pedido->id]);
        } catch (\Exception $e) {
            DB::rollBack();

            session()->flash('error', 'Error al procesar el pago: ' . $e->getMessage());
            Log::error('Error en checkout:', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
        }
    }

    private function generarClaveDigital()
    {
        return 'GAME-' . strtoupper(Str::random(4)) . '-' .
            strtoupper(Str::random(4)) . '-' .
            strtoupper(Str::random(4));
    }

    public function render()
    {
        return view('livewire.checkout-page');
    }
}
