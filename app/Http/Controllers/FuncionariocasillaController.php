<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Funcionario;
use App\Models\Casilla;
use App\Models\Rol;
use App\Models\Eleccion;
use App\Models\Funcionariocasilla;

use Illuminate\Support\Facades\DB;

class FuncionariocasillaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
        $sql = "SELECT fc.id, f.nombrecompleto as funcionario, c.ubicacion as casilla, r.descripcion as rol, e.periodo as eleccion 
         
            FROM funcionariocasilla fc INNER JOIN funcionario f ON fc.funcionario_id = f.id
            INNER JOIN casilla c ON fc.casilla_id = c.id 
            INNER JOIN rol r ON fc.rol_id = r.id
            INNER JOIN eleccion e ON fc.eleccion_id = e.id";
             

        $funcionariocasillas = DB::select($sql);
        return view("funcionariocasilla/list", 
        compact("funcionariocasillas"));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $funcionarios = Funcionario::all();
        $casillas = Casilla::all();
		$roles = Rol::all();
		$elecciones = Eleccion::all();

        return view("funcionariocasilla/create", 
        compact("funcionarios", "casillas","roles","elecciones"));
    
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
            'casilla_id' => 'required|integer',
            'rol_id' => 'required|integer',
            'eleccion_id'=>'required|integer',
        ]);

        
        $data = [
            "funcionario_id" => $request->funcionario_id,
            'casilla_id' => $request->casilla_id,
            "rol_id" => $request->rol_id,
            "eleccion_id" => $request->eleccion_id
        ];
        
        Funcionariocasilla::create($data);
        return redirect('funcionariocasilla')->with('success',
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
        $roles = Rol::all();
        $elecciones = Eleccion::all();
        $funcionariocasilla = Funcionariocasilla::find($id);

        return view("funcionariocasilla/edit", 
        compact("funcionariocasilla","funcionarios","casillas","roles","elecciones",));
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
            'rol_id' => 'required|integer',
            'eleccion_id'=>'required|integer',
        ]);

        
        $data = [
            "funcionario_id" => $request->funcionario_id,
            "casilla_id" => $request->casilla_id,
            "rol_id" => $request->rol_id,
            "eleccion_id" => $request->eleccion_id
        ];
        
        Funcionariocasilla::find($id)->update($data);
        return redirect('funcionariocasilla')->with('success',
            ' cambio realizado ...');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Funcionariocasilla::find($id)->delete();
        return redirect('funcionariocasilla'); 
    }
}