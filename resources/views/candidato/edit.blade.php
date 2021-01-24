@extends('plantilla')
@section('content')
<style>
	.uper {
	margin-top: 40px;
}
</style>

<div class="card">
	<div class="card-header">
		Editar candidato
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
	<form method="POST"
		action="{{ route('candidato.update', $candidato->id) }}"
		enctype="multipart/form-data">
		{{ csrf_field() }}
		@method('PUT')
		<div class="form-group">
		@csrf
		<label for="id">ID:</label>
		<input type="text"
			class="form-control"
			readonly="true"
			value="{{$candidato->id}}"
			name="id"/>
		</div>
		<div class="form-group">
			@csrf
			<label for="nombrecompleto">Nombre Completo:</label>
			<input type="text"
			value="{{$candidato->nombrecompleto}}"
			class="form-control"
			name="nombrecompleto"/>
		</div>
		<div class="form-group">
			@csrf
			<label for="sexo">Sexo:</label>
			<select name="sexo" class="form-control" value="{{$candidato->sexo}}">
				<option value="H" <?echo (($candidato->sexo=='H')? 'selected':'');?> >Hombre</option>
				<option value="M" <?echo (($candidato->sexo=='M')? 'selected':'');?> >Mujer</option>
			</select>
		</div>

		<div class="form-group">
			<label for="foto">Elija la foto del candidato</label>
			<input type="file" class="form-control" name="foto">
		</div>

		<div class="form-group">
			<label for="perfil">Elija el documento sobre el perfil</label>
			<input type="file" class="form-control" name="perfil">
		</div>
		<button type="submit" class="btn btn-primary">Guardar</button>
	</form>
	</div>
</div>
@endsection