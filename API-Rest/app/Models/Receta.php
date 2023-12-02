<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Receta extends Model
{
    use HasFactory;

    protected $table = 'receta';

    protected $fillable = [
        'nroReceta', 'fechaEmision', 'Remedio_id', 'Paciente_id', 'Medico_id'
    ];

    public function remedio()
    {
        return $this->belongsTo(Remedio::class);
    }

    public function medico()
    {
        return $this->belongsTo(Medico::class);
    }

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

}