@extends('plantilla')
@section('content')
<style>
.uper {margin-top: 40px;
}
</style>
<div class="card uper">
	<div class="card-header">
		Votos
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
		<form method="post" action="{{ route('imeiautorizado.store') }} " enctype="multipart/form-data">
			{{ csrf_field() }}

			<div class="form-group">
				@csrf
				<label for="funcionario">Funcionario:</label>
				<select name="funcionario_id">
					@foreach ($funcionarios as $funcionario)
						<option value="{{ $funcionario->id}}">{{ $funcionario->nombrecompleto}}</option>
					@endforeach
				</select>
			</div>

			<div class="form-group">
				@csrf
				<label for="eleccion">Eleccion:</label>
				<select name="eleccion_id">
					@foreach ($elecciones as $eleccion)
						<option value="{{ $eleccion->id }}">{{ $eleccion->periodo }}</option>
					@endforeach
				</select>
			</div>

			<div class="form-group">
				@csrf
				<label for="casilla">Casila:</label>
				<select name="casilla_id">
					@foreach ($casillas as $casilla)
						<option value="{{ $casilla->id}}">{{ $casilla->ubicacion}}</option>
					@endforeach
				</select>
			</div>

			<div class="form-group">
				@csrf
				<label for="imei">imei:</label>
				<input type="text" class="form-control" name="imei"/>
			</div>
			
			<button type="submit" class="btn btn-primary">Guardar</button>
		</form>
	</div>
</div>
@endsection
