<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockTienda extends Model
{
    protected $table = 'stock_tienda';

    protected $fillable = [
        'tienda_id',
        'producto_id',
        'cantidad',
        'cantidad_minima',
        'ubicacion'
    ];

    public function tienda(): BelongsTo
    {
        return $this->belongsTo(Tienda::class);
    }

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class);
    }
}