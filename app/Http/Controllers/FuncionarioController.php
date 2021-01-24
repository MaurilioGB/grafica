<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funcionario;

class FuncionarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $funcionarios = Funcionario::all();
        return view("/funcionario/list", compact('funcionarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('funcionario/create');
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
         'nombrecompleto' => 'required|max:100',
         'sexo' => 'required|max:1'
        ]);

        $data = ["id"=>$request->id,
            "nombrecompleto"=>$request->nombrecompleto,
            "sexo"=>$request->sexo];

        $funcionario = Funcionario::create($data);
        return redirect('funcionario')
        ->with('success', $funcionario->nombrecompleto . 'Agregafdo correctamente...');
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
        $funcionario = Funcionario::find($id);
        return view("funcionario/edit", compact('funcionario'));
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
         'nombrecompleto' => 'required|max:100',
         'sexo' => 'required|max:1'
        ]);

        $data = ["id"=>$request->id,
            "nombrecompleto"=>$request->nombrecompleto,
            "sexo"=>$request->sexo];

        Funcionario::whereId($id)->update($data);
        return redirect('funcionario')
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
        Funcionario::whereId($id)->delete();
        return redirect('funcionario');
    }
}
