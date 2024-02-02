<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Receta;


class Remedio extends Model
{
    use HasFactory;

    protected $table = 'remedio';

    protected $fillable = [
        'codigo', 'droga', 'medicamento'
    ];

    public function receta()
    {
        return $this->hasMany(Receta::class);
    }

    public function remedioreceta()
    {
        return $this->hasMany(RemedioReceta::class);
    }
}