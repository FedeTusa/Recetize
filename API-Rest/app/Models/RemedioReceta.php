<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class RemedioReceta extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'remedioreceta';

    protected $fillable = [
        'remedio_id', 'receta_id'
    ];

    public function remedio()
    {
        return $this->belongsTo(Remedio::class, 'remedio_id');
    }

    public function receta()
    {
        return $this->belongsTo(Receta::class, 'receta_id');
    }

}