<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Receta;


class Historial extends Model
{
    use HasFactory;

    protected $table = 'historial';
    public $timestamps = false;

    protected $fillable = [
        'fecha', 'accion', 'tipo', 'datos'
    ];

    public function receta()
    {
        return $this->hasMany(Receta::class);
    }
}

