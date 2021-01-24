<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CasillaController;
use App\Http\Controllers\CandidatoController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\EleccionController;
use App\Http\Controllers\EleccioncomiteController;
use App\Http\Controllers\VotoController;
use App\Http\Controllers\VotocandidatoController;
use App\Http\Controllers\FuncionariocasillaController;
use App\Http\Controllers\ImeiautorizadoController;


Route::get('/', function () {
return view('welcome');
});




Route::get('votocandidato/chart', [VotocandidatoController::class, 'generatechart']);

Route::get('casilla/pdf', [CasillaController::class, 'generatepdf']);
Route::resource('casilla', CasillaController::class);
Route::resource('candidato', CandidatoController::class);
Route::resource('funcionario', FuncionarioController::class);
Route::resource('rol', RolController::class);
Route::resource('eleccion', EleccionController::class);
Route::resource('eleccioncomite', EleccioncomiteController::class);
Route::resource('voto', VotoController::class);
Route::resource('votocandidato', VotocandidatoController::class);
Route::resource('funcionariocasilla', FuncionariocasillaController::class);
Route::resource('imeiautorizado', ImeiautorizadoController::class);
