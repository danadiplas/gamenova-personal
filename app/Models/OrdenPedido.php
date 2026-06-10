<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrdenPedido extends Model
{
    use HasFactory;

    protected $table = 'orden_pedido';

    protected $fillable = [
        'pedido_id',
        'producto_id',
        'cantidad',
        'precio_unitario',
        'subtotal',
        'clave_digital',
        'clave_generada_en',
        'metodo_entrega'
    ];

    protected $casts = [
        'cantidad' => 'integer',
        'precio_unitario' => 'decimal:2',
        'subtotal' => 'decimal:2',
        'clave_generada_en' => 'datetime'
    ];

    public function pedido(): BelongsTo
    {
        return $this->belongsTo(Pedido::class);
    }

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class);
    }

    public function getMetodoEntregaTextoAttribute(): string
    {
        return match ($this->metodo_entrega) {
            'digital' => 'Clave Digital',
            'recogida' => 'Recogida en tienda',
            'domicilio' => 'Envío a domicilio',
            default => 'No especificado'
        };
    }

    public function generarClaveDigital(): string
    {
        $clave = strtoupper(bin2hex(random_bytes(8)));
        $claveFormateada = implode('-', str_split($clave, 4));

        $this->update([
            'clave_digital' => $claveFormateada,
            'clave_generada_en' => now()
        ]);

        return $claveFormateada;
    }
}
