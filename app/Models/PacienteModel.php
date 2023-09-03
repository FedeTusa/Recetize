<?php

namespace App\Models;

use CodeIgniter\Model;

class PacienteModel extends Model
{
    protected $table            = 'paciente';
    protected $primaryKey       = 'dni';
    protected $allowedFields    = ['dni', 'nombre', 'apellido', 'celular', 'localidad', 'calle', 'altura'];

}
