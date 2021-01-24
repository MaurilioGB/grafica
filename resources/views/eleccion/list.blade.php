@extends('plantilla')
@section('content')
<style>
    .uper {
        margin-top: 40px;
    }
</style>
<div class="uper">
    @if(session()->get('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div><br />
    @endif
    <table class="table table-striped">
    <thead>
        <tr>
			<th>ID</th>
			<th>Periodo</th>
			<th>Fecha</th>
			<th>Fecha de Apertura</th>
			<th>Hora de Aperura</th>
			<th>Fecha de Cierre</th>
			<th>Hora de Cierre</th>
			<th>Observaciones</th>
			<td colspan="2">Action</td>
		</tr>
	</thead>
	<tbody>
		@foreach($elecciones as $eleccion)
			<tr>
				<td>{{$eleccion->id}}</td>
				<td>{{$eleccion->periodo}}</td>
				<td>{{$eleccion->fecha}}</td>
				<td>{{$eleccion->fechaapertura}}</td>
				<td>{{$eleccion->horaapertura}}</td>
				<td>{{$eleccion->fechacierre}}</td>
				<td>{{$eleccion->horacierre}}</td>
				<td>{{$eleccion->observaciones}}</td>
				<td><a href="{{ route('eleccion.edit', $eleccion->id)}}"
					class="btn btn-primary">Editar</a></td>
				<td>
				<form action="{{ route('eleccion.destroy', $eleccion->id)}}"
					method="post">
					@csrf
					@method('DELETE')
					<button class="btn btn-danger" type="submit"
					onclick="return confirm('Esta seguro de borrar {{$eleccion->periodo}}')" >Eliminar</button>
				</form>
				</td>
			</tr>
		@endforeach
	</tbody>
	</table>
<div>
@endsection