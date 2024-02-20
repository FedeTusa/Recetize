<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Receta extends Model
{
    use HasFactory;

    protected $table = 'receta';

    protected $fillable = [
        'nroReceta', 'fechaEmision', 'Paciente_id', 'Medico_id', 'borrado_logico'
    ];

    public function medico()
    {
        return $this->belongsTo(Medico::class);
    }

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function remedioreceta()
    {
        return $this->hasMany(RemedioReceta::class);
    }

}