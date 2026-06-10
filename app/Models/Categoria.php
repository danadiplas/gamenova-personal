<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str; // Añade esta línea

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias';

    protected $fillable = [
        'nombre',
        'slug',
        'descripcion',
        'categoria_padre_id',
        'imagen',
        'activa',
    ];

    // Evento para generar slug automáticamente
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($categoria) {
            if (empty($categoria->slug)) {
                $categoria->slug = Str::slug($categoria->nombre);
            }
        });

        static::updating(function ($categoria) {
            if ($categoria->isDirty('nombre') && empty($categoria->slug)) {
                $categoria->slug = Str::slug($categoria->nombre);
            }
        });
    }

    public function productos(): HasMany
    {
        return $this->hasMany(Producto::class);
    }

    public function parent()
    {
        return $this->belongsTo(Categoria::class, 'categoria_padre_id');
    }

    public function children()
    {
        return $this->hasMany(Categoria::class, 'categoria_padre_id');
    }
}
