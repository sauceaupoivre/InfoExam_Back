<?php

use App\Http\Controllers\AlerteController;
use App\Http\Controllers\EpreuveController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\ExamenController;
use App\Http\Controllers\API\ApiController;
use App\Http\Controllers\SalleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('formations.index');
})->middleware(['auth', 'isadmin']);

Route::get('/home', function () {return redirect()->route('formations.index');})->middleware(['auth', 'isadmin'])->name('home');


Route::resource('epreuves', EpreuveController::class)->middleware(['auth', 'isadmin']);

Route::resource('formations', FormationController::class)->middleware(['auth', 'isadmin']);

Route::resource('alertes', AlerteController::class)->middleware(['auth', 'isadmin']);

Route::resource('examens', ExamenController::class)->middleware(['auth', 'isadmin']);

Route::resource('salles', SalleController::class)->middleware(['auth', 'isadmin']);


// Route API
Route::apiResource("api", ApiController::class)->middleware(['auth', 'isadmin']);
Route::get('/api/date/{date}', [ApiController::class , 'showByDate'])->name("showByDate")->middleware(['auth', 'isadmin']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
