@extends('plantilla')
@section('content')
<style>
.uper {
margin-top: 40px;
}
</style>
<div class="card uper">
<div class="card-header">
Agregar Candidato
</div>
<div class="card-body">
@if ($errors->any())
<div class="alert alert-danger">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div><br />
@endif
<form method="post" action="{{ route('candidato.store') }} " enctype="multipart/form-data">
{{ csrf_field() }}
<div class="form-group">
@csrf
<label for="nombrecompleto">Nombre:</label>
<input type="text" class="form-control" name="nombrecompleto"/>
</div>

<div class="form-group">
@csrf
<label for="foto">Foto</label>
<input type="file" class="form-control" name="foto"/>
</div>

<div class="form-group">
@csrf
<label for="sexo">Sexo</label>
<select name="sexo">
<option value="H">Hombre</option>
<option value="M">Mujer</option>	
</select>
</div>

<div class="form-group">
@csrf
<label for="perfil">Perfil</label>
<input type="file" class="form-control" name="perfil"/>
</div>

<button type="submit" class="btn btn-primary">Guardar</button>
</form>
</div>
</div>
@endsection
