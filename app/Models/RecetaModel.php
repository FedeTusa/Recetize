<?php

namespace App\Models;

use CodeIgniter\Model;

class RecetaModel extends Model
{
    protected $table            = 'receta';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['nroReceta', 'fechaEmision', 'Remedio_codigo', 'Paciente_dni', 'Medico_matricula'];

}
