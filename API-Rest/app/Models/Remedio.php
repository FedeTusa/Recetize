<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Remedio extends Model
{
    use HasFactory;

    protected $table = 'remedio';

    protected $fillable = [
        'codigo', 'droga', 'medicamento'
    ];
}