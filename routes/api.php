<?php

use App\Http\Controllers\Api\V1\AdmissionController;
use App\Http\Controllers\Api\V1\AgendaController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\QueueController;
use App\Http\Controllers\Api\V1\TurnosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([
    'prefix' => 'admision',
    'middleware' => 'auth:sanctum',
], function(){
    //Route::get('search-user', [AdmissionController::class,'getUserByDni']);
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
//Route::post('logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//Para que funcione el logout esta ruta tiene que estar bajo un middleware auth o sanctum
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

//Rutas de prueba de cola de pacientes
//Route::post('cola-pacientes', [QueueController::class, 'addPatientToQueue']);
Route::get('search-user', [AdmissionController::class,'getUserByDni']);
Route::post('cola-pacientes', [AdmissionController::class,'addUserToQueue']);
Route::get('cola-pacientes', [QueueController::class, 'getNextPatientToQueue']);
Route::get('profesionales-practicas', [AdmissionController::class, 'getAdmisionData']);
//Agregar ruta para consultar turnos aca
// Route::post('agenda', [AdmissionController::class, 'addAgenda']);
Route::post('agenda', [AgendaController::class, 'addAgendaToProfessional']);
Route::post('turno', [TurnosController::class, 'agregarPacienteAlTurno']);
Route::get('turno/paciente', [TurnosController::class, 'buscarTurnoPaciente']);