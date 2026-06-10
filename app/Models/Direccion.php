<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Direccion extends Model
{
    use HasFactory;

    protected $table = 'direcciones';

    protected $fillable = [
        'user_id',
        'tipo',
        'nombre_direccion',
        'destinatario',
        'direccion',
        'ciudad',
        'provincia',
        'codigo_postal',
        'pais',
        'telefono',
        'es_principal'
    ];

    protected $casts = [
        'es_principal' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getDireccionCompletaAttribute(): string
    {
        return "{$this->direccion}, {$this->codigo_postal} {$this->ciudad}, {$this->provincia}, {$this->pais}";
    }
}
