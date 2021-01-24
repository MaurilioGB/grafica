<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidato;
use App\Models\Eleccion;
use App\Models\Casilla;
use App\Models\Votocandidato;
use App\Models\Voto;
use Barryvdh\DomPDF\Facade as PDF; //--- Se agregó esta línea
use Illuminate\Support\Facades\DB;

class VotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sql = "SELECT v.id, e.periodo as eleccion, c.ubicacion as casilla, v.evidencia from voto v INNER JOIN eleccion e ON v.eleccion_id=e.id INNER JOIN casilla c ON v.casilla_id=c.id";

          $votos = DB::select($sql);
           return view("voto/list", compact("votos")); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

         $casillas   = Casilla::all();
        $candidatos = Candidato::all();
        $elecciones = Eleccion::all();
        return view("voto/create",
        compact("casillas","candidatos","elecciones"));
    

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   public function store(Request $request)
    {

        //print_r($_POST); exit;
        $evidencia = "";
        $request->validate([
            'eleccion_id' => 'required',
            'casilla_id'=>'required',
            'evidencia'=>'required|mimes:pdf|max:8192'
        ]);
        if ($request->hasFile('evidencia')) {
            $evidencia = $request->evidencia->getClientOriginalName() ;
            $request->evidencia->move(public_path('uploads'), $evidencia);

        }
        $data = ["eleccion_id"=>$request->eleccion_id,
                "casilla_id"=>$request->casilla_id,
                "evidencia"=>$evidencia
            ];
        //--- inserta en voto
        $voto = Voto::create($data);
        $id = $voto->id;
        //--- insertar en votoscandidatos
        $candidatos = array_filter(
            $_POST,
            function ($f)  {
                return ( substr($f,0,9)=="candidato");
            },
            ARRAY_FILTER_USE_KEY
        );
        foreach ($candidatos as $key => $value) { 
            $candidato_id = intval(substr($key, 10));
            $datavotocandidato = ["voto_id" =>intval($id),
                   "candidato_id" => $candidato_id,
                   "votos" => intval($value)
                ];
            Votocandidato::create($datavotocandidato);
        }
        return redirect('voto')->with('success',
            ' guardado satisfactoriamente ...');
        //echo "Guardado satisfactoriamente ...";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $elecciones = Eleccion::all();
        $casillas = Casilla::all();
        $voto = Voto::find($id);
        
        return view('voto/edit',compact("voto","elecciones","casillas"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $request->validate([
            'casilla_id'=>'required|integer',
            'eleccion_id'=>'required|integer',
            'evidencia'=>'required'
        ]);

        if($request->hasFile('evidencia')){
           $evidencia = $request->evidencia->getClientOriginalName();
           $request->evidencia->move(public_path('uploads'), $evidencia);
        }

        $data = [
            "casilla_id" => $request->casilla_id ,
            "eleccion_id" => $request->eleccion_id,
            "evidencia"=> $evidencia
        ];

        Voto::whereId($id)->update($data);
        return redirect('voto')
        ->with('success', 'Actualizado correctamente...');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $voto = Voto::find($id);
        $voto->delete();
        return redirect('voto');
    }

     public function generatepdf()
    {
      $sql = "SELECT v.id, e.periodo as eleccion, c.ubicacion as casilla, v.evidencia from voto v INNER JOIN eleccion e ON v.eleccion_id=e.id INNER JOIN casilla c ON v.casilla_id=c.id";

          $votos = DB::select($sql);
      // print_r($casillas);
        $pdf = PDF::loadView('voto/vista', ['votos'=>$votos]);
        return $pdf->stream('voto.pdf');
    }
}
