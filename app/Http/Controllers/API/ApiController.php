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
    public function sallesBydate($date)
    {
        $cartouchesByDate = Examen::where('date','LIKE','%'.$date.'%')->get();
        $salles = $cartouchesByDate->load('salle')->pluck('salle')->unique();
        return response()->json($salles);
    }
    public function formationsBydate($date)
    {
        $cartouchesByDate = Examen::where('date','LIKE','%'.$date.'%')->get();
        $formations = $cartouchesByDate->load('formation')->pluck('formation')->unique();
        return response()->json($formations);
    }
    public function epreuvesBydate($date)
    {
        $cartouchesByDate = Examen::where('date','LIKE','%'.$date.'%')->get();
        $epreuves = $cartouchesByDate->load('epreuve')->pluck('epreuve')->unique();
        return response()->json($epreuves);
    }

    public function examen($date, $salle_id, $formation_id, $epreuve_id)
    {
        $examen = Examen::Where("date",'LIKE','%'.$date.'%')
                            ->where("salle_id",$salle_id)
                            ->where("formation_id",$formation_id)
                            ->where("epreuve_id",$epreuve_id)
                            ->first();
        return response()->json($examen);
    }
}
