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
			<th>Nombre Completo</th>
			<th>Foto</th>
			<th>Sexo</th>
			<th>Perfil</th>
			<td colspan="2">Action</td>
		</tr>
	</thead>
	<tbody>
		@foreach($candidatos as $candidato)
			<tr>
				<td>{{$candidato->id}}</td>
				<td>{{$candidato->nombrecompleto}}</td>
				<td><img src="uploads/{{$candidato->foto}}" width="150" height ="150" alt ="Aqui va la foto"></td>
				<td>{{$candidato->sexo}}</td>
				<td><a href="uploads/{{$candidato->perfil}}"> 
					<img src="uploads/icon-pdf.png" alt ="pdf" width="100" height ="100">  </a> 
				</td>
				<td><a href="{{ route('candidato.edit', $candidato->id)}}"
					class="btn btn-primary">Editar</a></td>
				<td>
				<form action="{{ route('candidato.destroy', $candidato->id)}}"
					method="post">
					@csrf
					@method('DELETE')
					<button class="btn btn-danger" type="submit"
					onclick="return confirm('Esta seguro de borrar {{$candidato->nombrecompleto}}')" >Eliminar</button>
				</form>
				</td>
			</tr>
		@endforeach
	</tbody>
	</table>
<div>
@endsection