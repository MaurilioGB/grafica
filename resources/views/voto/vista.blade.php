<!DOCTYPE HTML>
<HTML>
<head>
	<div style='text-align:center;'>	
   
		<h1>PDF generado desde etiquetas html:</h1>
		<h2> Voto</h2>
		<br>
</head>
   
   </div>
   <BODY>

    <table class="table table-striped" align="center">
		<thead>
			<tr>
				<th align="center">ID</th>
				<th align="center">ELECCION</th>
				<th align="center">CASILLA</th>
	
			</tr>
		</thead>
		<tbody>
			@foreach($votos as $voto)
			<tr>
				<td align="center">{{$voto->id}}</td>
				<td>{{$voto->eleccion}}</td>
				<td>{{$voto->casilla}}</td>
			</tr>
		@endforeach
	</tbody>
</table>

<div>
	<div style='text-align:center;'>	
   
   		<h3>&copy;MaurilioG.dev</h3> 
</div>
<script type="text/php">
		if (isset($pdf) ) {
				$pdf->page_script('
				$font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
				$pdf->text(270, 730, "Pagina $PAGE_NUM de $PAGE_COUNT", $font, 10);
				');
		}
</script>
   </BODY>
</HTML>