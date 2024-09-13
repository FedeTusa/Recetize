<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Receta;


class Paciente extends Model
{
    use HasFactory;

    protected $table = 'paciente';

    protected $fillable = ['dni', 'nombre', 'apellido', 'obrasocial', 'nroafiliado', 'prefijo', 'celular', 'email', 'provincia', 'localidad', 'cp', 'calle', 'altura'];

    public function receta()
    {
        return $this->hasMany(Receta::class);
    }
}