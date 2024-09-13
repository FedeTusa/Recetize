<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Receta extends Model
{
    use HasFactory;

    protected $table = 'receta';

    protected $fillable = [
        'nroReceta', 'fechaEmision', 'Paciente_id', 'nroafiliado', 'obrasocial', 'Medico_id', 'borrado_logico'
    ];

public function remedios()
    {
        return $this->hasMany(RemedioReceta::class, 'receta_id');
    }

    // Define la relación con el modelo Paciente
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }

    // Define la relación con el modelo Medico
    public function medico()
    {
        return $this->belongsTo(Medico::class, 'medico_id');
    }
}

