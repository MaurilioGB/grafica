@extends('plantilla')
@section('content')
<style>
	.uper {
		margin-top: 40px;
	}
</style>
<div class="card uper">
	<div class="card-header">	Editar Votos </div>
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
	<form method="POST" action="{{ route('voto.update', $voto->id) }}"
		enctype="multipart/form-data">
		{{ csrf_field() }}
		@method('PUT')

		<div class="form-group">
			@csrf
			<label for="id">ID:</label>
			<input type="text" 
			class="form-control" 
			readonly="true" 
			value="{{$voto->id}}"
			name="id"/>
		</div>

	<div class="form-group">
		@csrf
		<label for="eleccion">Eleccion:</label>
		<select name="eleccion_id">
			@foreach ($elecciones as $eleccion)
			  @php
			      $selected = ($voto->eleccion_id==$eleccion->id)?" selected":"";
			  @endphp
			<option value="{{$eleccion->id}}" {{$selected}}>{{$eleccion->periodo}}</option>
			@endforeach
		</select>
	</div>

	<div class="form-group">
		@csrf
		<label for="casilla">Casilla:</label>
		<select name="casilla_id">
			@foreach ($casillas as $casilla)
			  @php
			      $selected = ($voto->casilla_id==$casilla->id)?" selected":"";
			  @endphp
			<option value="{{$casilla->id}}" {{$selected}}>{{$casilla->ubicacion}}</option>
			@endforeach
		</select>
	</div>

		<div class="form-group">
			<label for="evidencia">Elija el documento sobre la evidencia</label>
			<input type="file" class="form-control" name="evidencia">
		</div>
  

		<button type="submit" class="btn btn-primary">Guardar</button>
	</form>
</div>
</div>
@endsection