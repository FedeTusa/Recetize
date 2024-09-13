<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Receta;


class Medico extends Model
{
    use HasFactory;

    protected $table = 'medico';

    protected $fillable = [
        'matricula', 'nombre', 'apellido', 'especialidad', 'prefijo', 'celular',  'email', 'provincia', 'localidad', 'cp', 'calle', 'altura'
    ];

    public function receta()
    {
        return $this->hasMany(Receta::class);
    }
}