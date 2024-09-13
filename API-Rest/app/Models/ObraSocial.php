<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Receta;


class ObraSocial extends Model
{
    use HasFactory;

    protected $table = 'obrasociales';

    protected $fillable = ['obrasocial'];

}