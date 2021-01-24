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
				<th>VOTO ID</th>
				<th>CANDIDATO</th>
				<th>VOTOS</th>
			</tr>
		</thead>
		<tbody>
			@foreach($votocandidatos as $votocandidato)
			<tr>
				<td>{{$votocandidato->voto}}</td>
				<td>{{$votocandidato->candidato}}</td>
				<td>{{$votocandidato->votos}}</td>
			</tr>
		@endforeach
	</tbody>
</table>
<div>
@endsection