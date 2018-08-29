<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleados extends Model
{
  protected $table="empleados";

  protected $primaryKey = 'id';

  protected $fillable = [
      'nombre',
      'apellido',
      'nb_direccion',
      'empresa',
      'email',
      'telefono',
  ];

  public function getEmpresa(){
    return $this->belongsTo('App\Empresa','empresa');
  }
}
