<?php

namespace App\Models;

use CodeIgniter\Model;

class MedicoModel extends Model
{
    protected $table            = 'medico';
    protected $primaryKey       = 'matricula';
    protected $allowedFields    = ['matricula', 'nombre', 'apellido', 'especialidad', 'localidad'];

}
