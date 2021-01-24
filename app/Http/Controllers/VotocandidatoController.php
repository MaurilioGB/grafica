<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidato;
use App\Models\Voto;
use App\Models\Votocandidato;
use Barryvdh\DomPDF\Facade as PDF; //--- Se agregó esta línea
use Illuminate\Support\Facades\DB;

class VotocandidatoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $sql="  SELECT v.id as voto, c.nombrecompleto as candidato,  vc.votos
        FROM votocandidato vc 
        INNER JOIN voto v ON vc.voto_id = v.id
        INNER JOIN candidato c ON vc.candidato_id = c.id
        ORDER BY voto"; 

        $votocandidatos = DB::select($sql);
        return view("votocandidato/list",compact("votocandidatos")); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function generatepdf()
    {
      $sql="  SELECT v.id as voto, c.nombrecompleto as candidato,  vc.votos
        FROM votocandidato vc 
        INNER JOIN voto v ON vc.voto_id = v.id
        INNER JOIN candidato c ON vc.candidato_id = c.id
        ORDER BY voto"; 

        $votocandidatos = DB::select($sql);
      // print_r($casillas);
        $pdf = PDF::loadView('votocandidato/vista', ['votocandidatos'=>$votocandidatos]);
        return $pdf->stream('votocandidato.pdf');
    }

    public function generatechart()
    {
       // $sql = "SELECT candidato_id , votos FROM votocandidato GROUP BY candidato_id";
        $sql ="SELECT votos,candidato_id FROM votocandidato";
       

        $votocandidatos = DB::select($sql);
        return view("votocandidato/chart",['votocandidatos'=>$votocandidatos]);
     }
}
