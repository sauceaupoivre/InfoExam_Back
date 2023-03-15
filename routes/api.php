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
Route::get('/cartouches/date/{date}', [ApiController::class , 'cartouchesByDate'])->name("cartouchesByDate");
Route::get('/cartouches/all', [ApiController::class , 'allCartouches'])->name("allCartouches");
Route::get('/cartouches/{id}', [ApiController::class , 'cartouche'])->name("cartouche");

Route::get('/salles/all', [ApiController::class , 'allSalles'])->name("allSalles");

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
