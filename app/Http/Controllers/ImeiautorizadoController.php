<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Funcionario;
use App\Models\Eleccion;
use App\Models\Casilla;
use App\Models\Imeiautorizado;

use Illuminate\Support\Facades\DB;

class ImeiautorizadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $sql = "SELECT ia.id, f.nombrecompleto as funcionario, e.periodo as eleccion, 
        c.ubicacion as casilla 
            FROM imeiautorizado ia INNER JOIN funcionario f ON ia.funcionario_id = f.id
            INNER JOIN eleccion e ON ia.eleccion_id = e.id
            INNER JOIN casilla c ON ia.casilla_id = c.id "; 

        $imeiautorizados = DB::select($sql);
        return view("imeiautorizado/list", 
        compact("imeiautorizados"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $funcionarios = Funcionario::all();
        $elecciones = Eleccion::all();
        $casillas = Casilla::all();
        
        return view("imeiautorizado/create", 
        compact("funcionarios", "elecciones", "casillas"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'funcionario_id'=>'required|integer',
            'eleccion_id'=>'required|integer',
            'casilla_id' => 'required|integer',
            'imei' => 'required|max:20'
            
        ]);

        
        $data = [
            "funcionario_id" => $request->funcionario_id,
            "casilla_id" => $request->casilla_id,
            "eleccion_id" => $request->eleccion_id,
            "imei"=> $request->imei
        ];
        
        Imeiautorizado::create($data);
        return redirect('imeiautorizado')->with('success',
            ' guardado satisfactoriamente ...');
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
        $funcionarios = Funcionario::all();
        $casillas = Casilla::all();
        $elecciones = Eleccion::all();
        $imeiautorizado = Imeiautorizado::find($id);

        return view("imeiautorizado/edit", 
        compact("imeiautorizado", "funcionarios","casillas", "elecciones"));
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
            'funcionario_id'=>'required|integer',
            'casilla_id'=>'required|integer',
            'eleccion_id'=>'required|integer',
            'imei'=>'required|max:20'
        ]);
        
        $data = [
            "funcionario_id" => $request->funcionario_id ,
            "casilla_id" => $request->casilla_id ,
            "eleccion_id" => $request->eleccion_id,
            "imei" => $request->imei
        ];

        Imeiautorizado::find($id)->update($data);
        return redirect('imeiautorizado')->with('success',
            ' Cambio realizado ...');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Imeiautorizado::find($id)->delete();
        return redirect('imeiautorizado');
    }
}
