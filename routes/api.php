<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ApiController;

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

// Route API
Route::get('/cartouches/all', [ApiController::class , 'allCartouches'])->name("allCartouches");
Route::get('/cartouches/{id}', [ApiController::class , 'cartouche'])->name("cartouche");
Route::get('/cartouches/alertes/{id}', [ApiController::class , 'getAlertes'])->name("getAlertes");
Route::get('/cartouches/date/{date}', [ApiController::class , 'cartouchesByDate'])->name("cartouchesByDate");

Route::get('/salles/date/{date}', [ApiController::class , 'sallesBydate'])->name("sallesBydate");

Route::get('/formations/date/{date}', [ApiController::class , 'formationsBydate'])->name("formationsBydate");

Route::get('/epreuves/date/{date}', [ApiController::class , 'epreuvesBydate'])->name("epreuvesBydate");

Route::get("/examen/{date}/{salle_id}/{formation_id}/{epreuve_id}",[ApiController::class,"examen"])->name("oneExamen");

route::get("/cartouches/examen/start/now",[ApiController::class,"dateNow"])->name("dateNow");

Route::put('/cartouches/repere/{id}', [ApiController::class, 'updateRepere'])->name("updateRepere");
Route::put('/cartouches/commentaire/{id}', [ApiController::class, 'updateComment'])->name("updateComment");
Route::put('/cartouches/alerte/done/{id}', [ApiController::class, 'updateAlert'])->name("updateAlert");
Route::put('/cartouches/examen/start/{id}', [ApiController::class, 'startTime'])->name("startTime");
Route::put('/cartouches/examen/start/stop/{id}', [ApiController::class, 'stopTime'])->name("stopTime");



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


