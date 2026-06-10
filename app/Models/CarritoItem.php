<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CarritoItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'producto_id',
        'cantidad',
        'precio_carrito',
        'metodo_entrega_carrito',
        'tienda_recogida_id',
        'updated_at'
    ];

    protected $casts = [
        'cantidad' => 'integer',
        'precio_carrito' => 'float'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class);
    }

    public function tiendaRecogida(): BelongsTo
    {
        return $this->belongsTo(Tienda::class, 'tienda_recogida_id');
    }
}
