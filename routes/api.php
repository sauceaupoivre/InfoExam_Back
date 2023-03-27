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

Route::get('/cartouches/date/{date}', [ApiController::class , 'cartouchesByDate'])->name("cartouchesByDate");
Route::get('/salles/date/{date}', [ApiController::class , 'sallesBydate'])->name("sallesBydate");
Route::get('/formations/date/{date}', [ApiController::class , 'formationsBydate'])->name("formationsBydate");
Route::get('/epreuves/date/{date}', [ApiController::class , 'epreuvesBydate'])->name("epreuvesBydate");

Route::get("/examen/{date}/{salle_id}/{formation_id}/{epreuve_id}",[ApiController::class,"examen"])->name("oneExamen");

Route::put('/cartouches/repere/{id}', [ApiController::class, 'updateRepere'])->name("updateRepere");
Route::put('/cartouches/commentaire/{id}', [ApiController::class, 'updateComment'])->name("updateComment");

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


