<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Empresa;
use App\Empleados;

class EmpleadoController extends Controller
{
  public function index()
  {
    $empresas = Empresa::orderBy('name','asc')->get();
    $empleados = Empleados::orderBy('id','asc')->get();
    return view('empleados')->with('empresas',$empresas)->with('empleados',$empleados);
  }

  public function store(Request $request)
  {
    $empleado = new Empleados();


    $empleado->nombre   = $request->Nombre;
    $empleado->apellido = $request->Apellido;
    $empleado->empresa  = $request->empresa;
    $empleado->email    = $request->Email;
    $empleado->telefono = $request->tel;
    $empleado->save();
    return redirect()->route('empelados');
  }

  public function update(Request $request,$id)
  {
    $empleado = Empleados::find($id);

    $empleado->nombre   = $request->Nombre;
    $empleado->apellido = $request->Apellido;
    $empleado->empresa  = $request->empresa;
    $empleado->email    = $request->Email;
    $empleado->telefono = $request->tel;
    $empleado->save();
    return redirect()->route('empelados');
  }

  public function destroy($id)
  {
    $empleado = Empleados::find($id);
    $empleado->delete();
    return redirect()->route('empelados');
  }
}
