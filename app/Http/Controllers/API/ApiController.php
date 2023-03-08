<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Examen;
use App\Models\Salle;
use DateTime;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allCartouches()
    {
        try {
            $cartouches = Examen::with('salle','alertes','formation','epreuve')->get();
            return response()->json($cartouches);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function cartouche($id)
    {
        try {
            $cartouche = Examen::find($id);
            return response()->json($cartouche->load('salle','alertes','formation','epreuve'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function cartouchesByDate($date)
    {
        try {
            $cartouchesByDate = Examen::where('date','LIKE','%'.$date.'%')->get();
            return response()->json($cartouchesByDate->load('salle','alertes','formation','epreuve'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function allSalles()
    {
        try {
            $salles = Salle::all();
            return response()->json($salles);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }


}
