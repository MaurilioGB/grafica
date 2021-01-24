@extends('plantilla')
@section('content')
<style>
.uper {margin-top: 40px;
}
</style>
<div class="card uper">
	<div class="card-header">
		Editar Comite de Elecciones
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
		<form method="post" action="{{ route('eleccioncomite.update', $eleccioncomite->id) }} " enctype="multipart/form-data">
			@method('PUT')
			{{ csrf_field() }}

			<div class="form-group">
				@csrf
				<label for="eleccion">Eleccion:</label>
				<select name="eleccion_id">
                    @foreach ($elecciones as $eleccion)
                        @php
                            $selected = ($eleccioncomite->eleccion_id==$eleccion->id)?" selected ":"";
                        @endphp
                        <option value="{{ $eleccion->id }}" {{ $selected }}>{{ $eleccion->periodo }}</option>
                    @endforeach
                </select>			
            </div>

			<div class="form-group">
				@csrf
				<label for="funcionario">Funcionario:</label>
				<select name="funcionario_id">
                    @foreach ($funcionarios as $funcionario)
                        @php
                            $selected = ($eleccioncomite->funcionario_id==$funcionario->id)?" selected ":"";
                        @endphp
                        <option value="{{ $funcionario->id }}" {{$selected}}>{{ $funcionario->nombrecompleto }}</option>
                    @endforeach
                </select>
			</div>

			<div class="form-group">
				@csrf
				<label for="rol">Rol:</label>
				<select name="rol_id">
                    @foreach ($roles as $rol)
                        @php
                            $selected = ($eleccioncomite->rol_id==$rol->id)?" selected ":"";
                        @endphp
                        <option value="{{ $rol->id }}" {{ $selected }}>{{ $rol->descripcion }}</option>
                    @endforeach
                </select>
			</div>
			
			<button type="submit" class="btn btn-primary">Guardar</button>
		</form>
	</div>
</div>
@endsection