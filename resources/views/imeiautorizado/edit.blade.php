@extends('plantilla')
@section('content')
<style>
.uper {margin-top: 40px;
}
</style>
<div class="card uper">
	<div class="card-header">
		Editar Imei
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
		<form method="post" action="{{ route('imeiautorizado.update', $imeiautorizado->id) }} " enctype="multipart/form-data">
			@method('PUT')
			{{ csrf_field() }}

			<div class="form-group">
				@csrf
				<label for="funcionario">Funcionario:</label>
				<select name="funcionario_id">
                    @foreach ($funcionarios as $funcionario)
                        @php
                            $selected = ($imeiautorizado->funcionario_id==$funcionario->id)?" selected ":"";
                        @endphp
                        <option value="{{ $funcionario->id }}" {{$selected}}>{{ $funcionario->nombrecompleto }}</option>
                    @endforeach
                </select>
			</div>

			<div class="form-group">
				@csrf
				<label for="eleccion">Eleccion:</label>
				<select name="eleccion_id">
                    @foreach ($elecciones as $eleccion)
                        @php
                            $selected = ($imeiautorizado->eleccion_id==$eleccion->id)?" selected ":"";
                        @endphp
                        <option value="{{ $eleccion->id }}" {{ $selected }}>{{ $eleccion->periodo }}</option>
                    @endforeach
                </select>			
            </div>

			<div class="form-group">
				@csrf
				<label for="casilla">Casilla:</label>
				<select name="casilla_id">
                    @foreach ($casillas as $casilla)
                        @php
                            $selected = ($imeiautorizado->casilla_id==$casilla->id)?" selected ":"";
                        @endphp
                        <option value="{{ $casilla->id }}" {{$selected}}>{{ $casilla->ubicacion }}</option>
                    @endforeach
                </select>
			</div>

			<div class="form-group">
				@csrf
				<label for="imei">Imei:</label>
				<input type="text" value="{{$imeiautorizado->imei}}" 
				class="form-control"
				name="imei"/>
			</div>
			
			<button type="submit" class="btn btn-primary">Guardar</button>
		</form>
	</div>
</div>
@endsection