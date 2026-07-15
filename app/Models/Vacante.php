<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vacante extends Model
{
    //
    protected $fillable = ['empresa_id', 'titulo', 'descripcion', 'requisitos', 'tipo_empleo', 'modalidad', 'ubicacion', 'salario_min', 'salario_max', 'fecha_cierre', 'estado'];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function carreras()
    {
        return $this->belongsToMany(Carrera::class, 'vacante_carrera');
    }

    public function postulaciones()
    {
        return $this->hasMany(Postulacion::class);
    }
}
