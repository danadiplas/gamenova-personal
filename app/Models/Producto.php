<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'slug',
        'descripcion',
        'descripcion_corta',
        'precio',
        'precio_rebajado',
        'categoria_id',
        'proveedor_id',
        'plataforma',
        'desarrolladora',
        'publisher',
        'fecha_lanzamiento',
        'pegi',
        'imagen_principal',
        'galeria',
        'stock_online',
        'destacado',
        'activo',
        'formato'
    ];

    protected $casts = [
        'fecha_lanzamiento' => 'date',
        'precio' => 'decimal:2',
        'precio_rebajado' => 'decimal:2',
        'stock_online' => 'integer',
        'destacado' => 'boolean',
        'activo' => 'boolean',
        'galeria' => 'array',
    ];

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }

    public function proveedor(): BelongsTo
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function stock(): HasOne
    {
        return $this->hasOne(Stock::class);
    }

    public function stockTiendas(): HasMany
    {
        return $this->hasMany(StockTienda::class);
    }

    public function ordenesPedido()
    {
        return $this->hasMany(OrdenPedido::class);
    }

    public function carritoItems()
    {
        return $this->hasMany(CarritoItem::class);
    }

        // Accessor para stock_disponible (alias de stock_online)
    public function getStockDisponibleAttribute()
    {
        return $this->stock_online;
    }

    // Mutator para stock_disponible
    public function setStockDisponibleAttribute($value)
    {
        $this->attributes['stock_online'] = $value;
    }
}
