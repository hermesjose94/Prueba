<?php

namespace App\Http\Controllers;

use App\Empresa;

use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    public function index()
    {
      $empresas = Empresa::orderBy('name','asc')->get();
      return view('empresas')->with('empresas',$empresas);
    }

    public function store(Request $request)
    {
      $empresa = new Empresa();

      $file = $request->file('image');
      $name = 'tour_' . time() . '.' . $file->getClientOriginalExtension();
      $path = public_path() . '/img';
      $file->move($path,$name);

      $empresa->name  = $request->Nombre;
      $empresa->email = $request->Email;
      $empresa->logo  = $name;
      $empresa->web   = $request->Web;
      $empresa->save();
      return redirect()->route('empresas');
    }

    public function update(Request $request,$id)
    {
      $this->validate($request, [
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
       ]);
      $empresa = Empresa::find($id);

      if ($request->file('image')) {
        $path = public_path() . '/img/'. $empresa->logo;
        unlink($path);

        $file = $request->file('image');
        $name = 'logo_' . time() . '.' . $file->getClientOriginalExtension();
        $path = public_path() . '/img';
        $file->move($path,$name);
        $empresa->logo  = $name;
      }
      $empresa->name  = $request->Nombre;
      $empresa->email = $request->Email;
      $empresa->web   = $request->Web;
      $empresa->save();
      return redirect()->route('empresas');
    }

    public function destroy($id)
    {
      $empresa = Empresa::find($id);

      $path = public_path() . '/img/'. $empresa->logo;
      unlink($path);
      $empresa->delete();
      return redirect()->route('empresas');
    }
}
