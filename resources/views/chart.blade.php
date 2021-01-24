

@extends('plantilla')
@section('title','Panel de control')
@section('content')

<html>
  <head>
    <h1>Gráfica</h1>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['candidato', 'Total'],
          @foreach ($votocandidatos as $votocandidatos)
          ['candidato:{{$votocandidatos->candidato_id}}',{{$votocandidatos->votos}}],
          @endforeach
        ]);

        var options = {
          title: 'Grafica de voto candidatos'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart" style="width: 1000px; height: 500px;"></div>
  </body>
</html>


@endsection