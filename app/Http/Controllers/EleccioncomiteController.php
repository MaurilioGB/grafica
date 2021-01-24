<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Funcionario;
use App\Models\Rol;
use App\Models\Eleccion;
use App\Models\Eleccioncomite;

use Illuminate\Support\Facades\DB;

class EleccioncomiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sql = "SELECT ec.id, e.periodo as eleccion, f.nombrecompleto as funcionario, 
        r.descripcion as rol 
            FROM eleccioncomite ec INNER JOIN eleccion e ON ec.eleccion_id = e.id
            INNER JOIN funcionario f ON ec.funcionario_id = f.id
            INNER JOIN rol r ON ec.rol_id = r.id "; 

        $eleccioncomites = DB::select($sql);
        return view("eleccioncomite/list", 
        compact("eleccioncomites"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Rol::all();
        $elecciones = Eleccion::all();
        $funcionarios = Funcionario::all();

        return view("eleccioncomite/create", 
        compact("roles","elecciones","funcionarios"));
    
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
            'rol_id' => 'required|integer',
            'funcionario_id'=>'required|integer',
            'eleccion_id'=>'required|integer',
        ]);

        
        $data = [
            "rol_id" => $request->rol_id ,
            "funcionario_id" => $request->funcionario_id ,
            "eleccion_id" => $request->eleccion_id
        ];
        
        Eleccioncomite::create($data);
        return redirect('eleccioncomite')->with('success',
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
        $roles = Rol::all();
        $elecciones = Eleccion::all();
        $funcionarios = Funcionario::all();
        $eleccioncomite = Eleccioncomite::find($id);

        return view("eleccioncomite/edit", 
        compact("eleccioncomite","roles","elecciones","funcionarios"));
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
            'rol_id' => 'required|integer',
            'funcionario_id'=>'required|integer',
            'eleccion_id'=>'required|integer'
        ]);
        
        $data = [
            "rol_id" => $request->rol_id ,
            "funcionario_id" => $request->funcionario_id ,
            "eleccion_id" => $request->eleccion_id
        ];
        
        Eleccioncomite::find($id)->update($data);
        return redirect('eleccioncomite')->with('success',
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
        Eleccioncomite::find($id)->delete();
        return redirect('eleccioncomite'); 
    }
}