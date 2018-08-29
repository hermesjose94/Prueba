<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
  protected $table="empresa";

  protected $primaryKey = 'id';

  protected $fillable = [
      'name',
      'email',
      'logo',
      'web',
  ];

  public function empleados(){
    return $this->hasMany('App\Empleado','empresa','id');
  }
}
