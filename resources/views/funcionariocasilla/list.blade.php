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
			<th>Funcionario</th>
			<th>Casilla</th>
			<th>Rol</th>
			<th>Perido de Eleccion</th>
			<th colspan="2">Action</th>
		</tr>
	</thead>
	<tbody>
		@foreach($funcionariocasillas as $funcionariocasilla)
		
			<tr>
				<td>{{$funcionariocasilla->id}}</td>
				<td>{{$funcionariocasilla->funcionario}}</td>
				<td>{{$funcionariocasilla->casilla}}</td>
				<td>{{$funcionariocasilla->rol}}</td>
				<td>{{$funcionariocasilla->eleccion}}</td>

				<td><a href="{{ route('funcionariocasilla.edit', $funcionariocasilla->id)}}"
					class="btn btn-primary">Edit</a></td>
				<td>
					<form action="{{ route('funcionariocasilla.destroy', $funcionariocasilla->id)}}"
					method="post">
						@csrf
						@method('DELETE')
						<button class="btn btn-danger" type="submit"
						onclick="return confirm('Esta seguro de borrar a {{$funcionariocasilla->funcionario}} con rol de {{$funcionariocasilla->rol}}')" >Del</button>
					</form>
				</td>
			</tr>
		@endforeach

	</tbody>
	</table>
<div>
@endsection