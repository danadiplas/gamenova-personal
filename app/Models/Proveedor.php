<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Proveedor extends Model
{
    use HasFactory;

    // Especifica el nombre de la tabla (en español)
    protected $table = 'proveedores';

    protected $fillable = [
        'user_id',
        'nombre_empresa',
        'contacto',
        'telefono',
        'email',
        'direccion',
        'ciudad',
        'pais',
        'cif_nif',
        'activo',
    ];

    // RELACIÓN CON USUARIO
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // RELACIÓN CON PRODUCTOS
    public function productos(): HasMany
    {
        return $this->hasMany(Producto::class);
    }
}
