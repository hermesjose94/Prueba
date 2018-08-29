  @extends('main')

@section('title')
  Prueba
@endsection

@section('content')
  <div class="">
    <a class="btn btn-success" role="button" data-toggle="collapse" href="#form0" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-plus-square"></i> Crear Empresa</a>
  </div>
  <div class="collapse" id="form0">
    <hr>
    <form method="POST" action="{{route('crearEmpresa')}}" accept-charset="UTF-8" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="form-group {{ $errors->has('Nombre') ? 'has-error' : '' }}">
        <label for="Nombre">Nombre de la Empresa</label>
        <input required class="form-control" placeholder="Nombres" required="" name="Nombre" type="text" id="name">
      </div>
      <div class="form-group {{ $errors->has('Email') ? 'has-error' : '' }}">
        <label for="Codigo">Email</label>
        <input required class="form-control" placeholder="correo@domino.com" required="" name="Email" type="email" id="email">
      </div>
      <div class="form-group {{ $errors->has('Web') ? 'has-error' : '' }}">
        <label for="Password">WEB</label>
        <input required class="form-control" placeholder="http://domino.com" required="" name="Web" type="url" id="web">
      </div>
      <div class="form-group {{ $errors->has('Logo') ? 'has-error' : '' }}">
        <label for="Password">Logo</label>
        <input required type="file" name="image" accept="image/x-png,image/gif,image/jpeg" class="form-control" id="images0" onchange="validar('images0');">
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
                          <th>Email</th>
                          <th>Web</th>
                          <th>Accion</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach ($empresas as $empresa)
                      <tr>
                          <td>{{$empresa->id}}</td>
                          <td>{{$empresa->name}}</td>
                          <td>{{$empresa->email}}</td>
                          <td>{{$empresa->web}}</td>
                          <td >
                            <a class="btn btn-warning" role="button" data-toggle="collapse" href="#form{{$empresa->id}}" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            <a href="{{ route('eliminarEmpresa', $empresa->id) }}" onclick="return confirm('¿Seguro que deseas eliminar?')" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                          </td>
                      </tr>
                      <tr class="odd gradeX collapse"  id="form{{$empresa->id}}">
                        <td COLSPAN=7>
                            <form method="POST" action="{{route('editarEmpresa',$empresa->id)}}" accept-charset="UTF-8" enctype="multipart/form-data">
                              <input name="_method" type="hidden" value="PUT">
                              {{ csrf_field() }}
                              <div class="form-group {{ $errors->has('Nombre') ? 'has-error' : '' }}">
                                <label for="Nombre">Nombre de la Empresa</label>
                                <input value="{{$empresa->name}}" required class="form-control" placeholder="Nombres" required="" name="Nombre" type="text" id="name">
                              </div>
                              <div class="form-group {{ $errors->has('Email') ? 'has-error' : '' }}">
                                <label for="Codigo">Email</label>
                                <input value="{{$empresa->email}}" required class="form-control" placeholder="correo@domino.com" required="" name="Email" type="email" id="email">
                              </div>
                              <div class="form-group {{ $errors->has('Web') ? 'has-error' : '' }}">
                                <label for="Password">WEB</label>
                                <input value="{{$empresa->web}}" required class="form-control" placeholder="http://domino.com" required="" name="Web" type="url" id="web">
                              </div>
                              <div class="form-group {{ $errors->has('Logo') ? 'has-error' : '' }}">
                                <label for="Password">Logo</label>
                                <div class="row">
                                  <div class="col-md-2">
                                    <img width="100" height="100" src="{{ asset('img/'.$empresa->logo.'') }}" alt="logo" class="img-thumbnail">
                                  </div>
                                  <div class="col-md-4">
                                    <input  type="file" name="image" accept="image/x-png,image/gif,image/jpeg" class="form-control" id="images{{$empresa->id}}" onchange="validar('images{{$empresa->id}}');">
                                  </div>
                                </div>
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

@section('js')
  <script type="text/javascript">
      function validar(id) {
          console.log("Validando "+id);
          var fileUpload = $("#"+id)[0];
          var reader = new FileReader();
          reader.readAsDataURL(fileUpload.files[0]);
          reader.onload = function (e) {
              //Initiate the JavaScript Image object.
              var image = new Image();
              //Set the Base64 string return from FileReader as source.
              image.src = e.target.result;
              image.onload = function () {
                  //Determine the Height and Width.
                  var height = this.height;
                  var width = this.width;
                  if (height < 100 || width < 100) {
                      alert("Minimo 100x100.");
                      return false;
                  }else {
                    console.log("Sirve");
                  }
              };
            }
      }
  </script>
@endsection
