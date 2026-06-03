<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model {
    protected $table = 'tareas';

    // La tabla no tiene updated_at, solo created_at
    const UPDATED_AT = null;

    protected $fillable = [
        'titulo',
        'descripcion',
        'estado',
        'usuario_id'
    ];

    public function usuario() {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}