<?php

use App\Http\Controllers\AlerteController;
use App\Http\Controllers\EpreuveController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\ExamenController;
use App\Http\Controllers\SalleController;
use App\Http\Livewire\ApiDocs;

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

Route::get('/api-docs', function () {return view('api-docs');})->name('APIDocs');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::get('/epreuves/{id}/formations',[ExamenController::class,"epreuveFormations"])->name("epreuveForms");
Route::post("/formations/search",[FormationController::class,"formationsSearch"])->name("formationsSearch");
Route::post("/examens/search",[ExamenController::class,"examensSearch"])->name("examensSearch");
Route::post("/epreuves/search",[EpreuveController::class,"epreuveSearch"])->name("epreuveSearch");
Route::Post("/formations/search",[FormationController::class,"formationsSearch"])->name("formationsSearch");
route::Post("/salles/search",[SalleController::class,"salleSearch"])->name("salleSearch");
