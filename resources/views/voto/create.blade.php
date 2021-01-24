@extends('plantilla')
@section('content')
<style>
	.uper {
		margin-top: 40px;
	}
</style>
<div class="card uper">
	<div class="card-header">
	Agregar Voto 
</div>
<div class="card-body">
	@if ($errors->any())
	<div class="alert alert-danger">
		<ul>
			@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>
</div><br/>
@endif
<form method="post" action="{{ route('voto.store') }} " enctype="multipart/form-data">
	{{ csrf_field() }}

	<div class="form-group">
		@csrf
		<label for="eleccion">Eleccion:</label>
		<select name="eleccion_id">
			@foreach ($elecciones as $eleccion)
			<option value="{{$eleccion->id}}">{{$eleccion->periodo}}</option>
			@endforeach
		</select>
	</div>

	<div class="form-group">
		@csrf
		<label for="casilla">Casilla:</label>
		<select name="casilla_id">
			@foreach ($casillas as $casilla)
			<option value="{{$casilla->id}}">{{$casilla->ubicacion}}</option>
			@endforeach
		</select>
	</div>

            <div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Candidato</th>
                            <th>Foto</th>
                            <th>Votos</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($candidatos as $candidato)
                        <tr>
                            <td>{{$candidato->id}}</td>
                            <td>{{$candidato->nombrecompleto}}</td>
                            <td><img src="uploads/{{$candidato->foto}}" alt="foto"> </td>
                            <td>
                            	<input type="number" id="candidato_{{$candidato->id}}" 
                                name="candidato_{{$candidato->id}}" class="voto" value="0" required /> </td>
                        </tr>
                        @endforeach    
                    </tbody>
                </table>
            </div>



	 <div class="form-group">
                @csrf
                <label for="evidencia">Evidencia:</label>
                <input type="file" name="evidencia"  accept="application/pdf" id="evidencia" >
            </div>



	<button type="submit" class="btn btn-primary" onClick="return validate()">Guardar</button>
</form>
</div>
</div>
@endsection

@section('page-script')
    <script type="text/javascript" src="/js/voto.js"></script>
@stop