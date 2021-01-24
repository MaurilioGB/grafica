@extends('plantilla')
@section('content')
<style>
.uper {margin-top: 40px;
}
</style>
<div class="card uper">
	<div class="card-header">
		Agregar Funcionario
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
		<form method="post" action="{{ route('funcionario.store') }} " enctype="multipart/form-data">
			{{ csrf_field() }}
			<div class="form-group">
				@csrf
				<label for="nombrecompleto">Nombre:</label>
				<input type="text" class="form-control" 
				maxlength="100"
				name="nombrecompleto"/>
			</div>
			<div class="form-group">
				@csrf
				<label for="sexo">Sexo:</label>
				<input type="text" class="form-control" 
				name="sexo" maxlength="1" />
			</div>
			<button type="submit" class="btn btn-primary">Guardar</button>
		</form>
	</div>
</div>
@endsection
