<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'numero_pedido',
        'direccion_envio_id',
        'direccion_facturacion_id',
        'subtotal',
        'envio',
        'iva',
        'total',
        'estado',
        'metodo_pago',
        'notas',
        'fecha_pedido',
        'fecha_envio',
        'fecha_entrega',
        'tracking_number',
        'metodo_entrega',
    ];

    protected $casts = [
        'fecha_pedido' => 'datetime',
        'fecha_envio' => 'datetime',
        'fecha_entrega' => 'datetime',
        'subtotal' => 'decimal:2',
        'envio' => 'decimal:2',
        'iva' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function direccionEnvio(): BelongsTo
    {
        return $this->belongsTo(Direccion::class, 'direccion_envio_id');
    }

    public function direccionFacturacion(): BelongsTo
    {
        return $this->belongsTo(Direccion::class, 'direccion_facturacion_id');
    }

    public function getMetodoEntregaAttribute()
    {
        return $this->attributes['metodo_entrega'] ?? 'domicilio';
    }
    
    // Relación con orden_pedido (detalles)
    public function ordenes(): HasMany
    {
        return $this->hasMany(OrdenPedido::class, 'pedido_id');
    }
}
