<?php

namespace Database\Seeders;

use App\Models\Pedido;
use App\Models\OrdenPedido;
use App\Models\User;
use App\Models\Producto;
use App\Models\Direccion;
use Illuminate\Database\Seeder;

class PedidoSeeder extends Seeder
{
    public function run(): void
    {
        $clientes = User::where('rol', 'cliente')->take(2)->get();
        $estados = ['pendiente', 'confirmado', 'procesando', 'enviado', 'entregado'];

        foreach ($clientes as $cliente) {
            $direcciones = Direccion::where('user_id', $cliente->id)->get();

            for ($i = 1; $i <= 2; $i++) {
                $pedido = Pedido::create([
                    'user_id' => $cliente->id,
                    'numero_pedido' => 'PED-' . strtoupper(uniqid()),
                    'direccion_envio_id' => $direcciones->first()->id,
                    'direccion_facturacion_id' => $direcciones->first()->id,
                    'subtotal' => 0,
                    'envio' => 4.99,
                    'iva' => 0,
                    'total' => 4.99,
                    'estado' => $estados[array_rand($estados)],
                    'metodo_pago' => ['tarjeta', 'paypal', 'transferencia'][array_rand([0, 1, 2])],
                    'fecha_pedido' => now()->subDays(rand(1, 30)),
                ]);

                $productos = Producto::inRandomOrder()->take(rand(1, 3))->get();
                $subtotal = 0;

                foreach ($productos as $producto) {
                    $cantidad = rand(1, 2);
                    $precio = $producto->precio_rebajado ?? $producto->precio;
                    $subtotalProducto = $cantidad * $precio;
                    $subtotal += $subtotalProducto;

                    OrdenPedido::create([
                        'pedido_id' => $pedido->id,
                        'producto_id' => $producto->id,
                        'cantidad' => $cantidad,
                        'precio_unitario' => $precio,
                        'subtotal' => $subtotalProducto,
                    ]);
                }

                $iva = $subtotal * 0.21;
                $total = $subtotal + $pedido->envio + $iva;

                $pedido->update([
                    'subtotal' => $subtotal,
                    'iva' => $iva,
                    'total' => $total,
                ]);
            }
        }

        $this->command->info('✅ Pedidos creados.');
    }
}
