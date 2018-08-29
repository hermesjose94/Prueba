  @extends('main')

@section('title')
  Prueba
@endsection

@section('content')
  <div class="">
    <a class="btn btn-success" role="button" data-toggle="collapse" href="#form0" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-plus-square"></i> Crear Empleado</a>
  </div>
  <div class="collapse" id="form0">
    <hr>
    <form method="POST" action="{{route('crearEmpleado')}}" accept-charset="UTF-8" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="form-group {{ $errors->has('Nombre') ? 'has-error' : '' }}">
        <label for="Nombre">Nombre</label>
        <input required class="form-control" placeholder="Nombres" required="" name="Nombre" type="text" id="name">
      </div>
      <div class="form-group {{ $errors->has('Nombre') ? 'has-error' : '' }}">
        <label for="Apellido">Apellido</label>
        <input required class="form-control" placeholder="Apellidos" required="" name="Apellido" type="text" id="apellido">
      </div>
      <div class="form-group {{ $errors->has('Logo') ? 'has-error' : '' }}">
        <label for="Password">Empresa</label>
        <select class="form-control" name="empresa">
          <option value="">Seleccione</option>
          @foreach ($empresas as $empresa)
            <option value="{{$empresa->id}}">{{$empresa->name}}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group {{ $errors->has('Email') ? 'has-error' : '' }}">
        <label for="Codigo">Email</label>
        <input required class="form-control" placeholder="correo@domino.com" required="" name="Email" type="email" id="email">
      </div>
      <div class="form-group {{ $errors->has('tel') ? 'has-error' : '' }}">
        <label for="tel">Telefono</label>
        <input required class="form-control" placeholder="041412421231" required="" name="tel" type="tel" id="tel">
      </div>

      <div class="form-group">
        <button class="btn btn-success" type="submit"><i class="fa  fa-upload"></i> Registrar</button>
      </div>
  </form>
  </div>
  <hr>
  <div class="panel panel-default">
      <div class="panel-heading">
          Empresas
      </div>
      <!-- /.panel-heading -->
      <div class="panel-body">
          <div class="table-responsive">
              <table class="table">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>Nombre</th>
                          <th>Apellido</th>
                          <th>Empresa</th>
                          <th>Email</th>
                          <th>Telefono</th>
                          <th>Accion</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach ($empleados as $empleado)
                      <tr>
                          <td>{{$empleado->id}}</td>
                          <td>{{$empleado->nombre}}</td>
                          <td>{{$empleado->apellido}}</td>
                          <td>{{$empleado->getEmpresa->name}}</td>
                          <td>{{$empleado->email}}</td>
                          <td>{{$empleado->telefono}}</td>
                          <td >
                            <a class="btn btn-warning" role="button" data-toggle="collapse" href="#form{{$empleado->id}}" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            <a href="{{ route('eliminarEmpleado', $empleado->id) }}" onclick="return confirm('¿Seguro que deseas eliminar?')" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                          </td>
                      </tr>
                      <tr class="odd gradeX collapse"  id="form{{$empleado->id}}">
                        <td COLSPAN=7>
                            <form method="POST" action="{{route('editarEmpleado',$empleado->id)}}" accept-charset="UTF-8" enctype="multipart/form-data">
                              <input name="_method" type="hidden" value="PUT">
                              {{ csrf_field() }}
                              <div class="form-group {{ $errors->has('Nombre') ? 'has-error' : '' }}">
                                <label for="Nombre">Nombre</label>
                                <input value="{{$empleado->nombre}}" required class="form-control" placeholder="Nombres" required="" name="Nombre" type="text" id="name">
                              </div>
                              <div class="form-group {{ $errors->has('Nombre') ? 'has-error' : '' }}">
                                <label for="Apellido">Apellido</label>
                                <input value="{{$empleado->apellido}}" required class="form-control" placeholder="Apellidos" required="" name="Apellido" type="text" id="apellido">
                              </div>
                              <div class="form-group {{ $errors->has('Logo') ? 'has-error' : '' }}">
                                <label for="Password">Empresa</label>
                                <select class="form-control" name="empresa">
                                  <option value="{{$empleado->empresa}}">{{$empleado->getEmpresa->name}}</option>
                                  @foreach ($empresas as $empresa)
                                    @if ($empleado->empresa !=  $empresa->id)
                                      <option value="{{$empresa->id}}">{{$empresa->name}}</option>
                                    @endif

                                  @endforeach
                                </select>
                              </div>
                              <div class="form-group {{ $errors->has('Email') ? 'has-error' : '' }}">
                                <label for="Codigo">Email</label>
                                <input value="{{$empleado->email}}" required class="form-control" placeholder="correo@domino.com" required="" name="Email" type="email" id="email">
                              </div>
                              <div class="form-group {{ $errors->has('tel') ? 'has-error' : '' }}">
                                <label for="tel">Telefono</label>
                                <input value="{{$empleado->telefono}}" required class="form-control" placeholder="041412421231" required="" name="tel" type="tel" id="tel">
                              </div>
                              <div class="form-group">
                                <button class="btn btn-success" type="submit">Editar</button>
                              </div>
                          </form>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
              </table>
          </div>
          <!-- /.table-responsive -->
      </div>
      <!-- /.panel-body -->
  </div>
@endsection
