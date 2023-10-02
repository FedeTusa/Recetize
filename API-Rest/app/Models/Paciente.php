<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Paciente extends Model
{
    use HasFactory;

    protected $table = 'paciente';

    protected $fillable = [
        'dni', 'nombre', 'apellido', 'celular', 'localidad', 'calle', 'altura'
    ];
}