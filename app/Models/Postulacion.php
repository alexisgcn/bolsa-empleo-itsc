<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Postulacion extends Model
{
    //
    protected $table = 'postulaciones';

    protected $fillable = ['vacante_id', 'estudiante_id', 'carta_presentacion', 'estado'];

    public function vacante()
    {
        return $this->belongsTo(Vacante::class);
    }

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }
}
