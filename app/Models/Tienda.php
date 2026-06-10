<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tienda extends Model
{
    use HasFactory;

    protected $table = 'tiendas';

    protected $fillable = [
        'nombre',
        'direccion',
        'ciudad',
        'provincia',
        'codigo_postal',
        'telefono',
        'email',
        'horario',
        'latitud',
        'longitud',
        'activa',
    ];

    public function stockTiendas(): HasMany
    {
        return $this->hasMany(StockTienda::class);
    }
}
