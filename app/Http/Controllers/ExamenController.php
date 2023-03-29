<?php

namespace App\Http\Controllers;

use App\Models\Examen;
use App\Models\Epreuve;
use App\Models\Salle;
use App\Models\Formation;
use Illuminate\Http\Request;
use DateTime;
use Carbon\Carbon;

class ExamenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $examens = Examen::all();
        $salles = Salle::All();
        $epreuves = Epreuve::All();
        return view("examens",compact("examens","salles","epreuves"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $epreuve = Epreuve::find($request->epreuve);
        $examen = new Examen;
        $examen->estdematerialise = $request->estdematerialise;
        $examen->repere = $request->repere;
        $examen->commentaire = $request->commmentaire;
        $examen->regle = $request->regle;
        $examen->salle_id=$request->salle;
        $examen->epreuve_id = $request->epreuve;
        $examen->formation_id = $request->formation;
        $date = new DateTime($request->input('date'));
        $examen->date = $date->format('Y-m-d');

        $examen->debut=$request->hd;
        $debut = Carbon::createFromFormat('H:i', $examen->debut);
        $fin = Carbon::createFromFormat('H:i:s', $epreuve->duree);
        $examen->fin = $debut->addMinutes($fin->minute)->addHours($fin->hour);

        if($request->calculatrice == null)
        {
            $examen->calculatrice = 0;
        }
        else
        {
            $examen->calculatrice = $request->calculatrice;
        }

        if($request->dictionnaire == null)
        {
            $examen->dictionnaire = 0;
        }
        else
        {
            $examen->dictionnaire =$request->dictionnaire;
        }

        $examen->save();
        return redirect()->route('examens.index')->with('success', 'Examens créé avec succès.');
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
        //
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
        $examen = Examen::find($id);
        $epreuve = Epreuve::find($examen->epreuve->id);
        $examen->estdematerialise = $request->estdematerialise;
        $examen->repere = $request->repere;
        $examen->commentaire = $request->commmentaire;
        $examen->regle = $request->regle;

        if($request->salle == !null)
        {
            $examen->salle_id=$request->salle;
        }
        if($request->epreuve == !null)
        {
            $examen->epreuve_id = $request->epreuve;
        }
        if($request->formation == !null)
        {
            $examen->formation_id = $request->formation;
        }

        $date = new DateTime($request->input('date'));
        $examen->date = $date->format('Y-m-d');

        $examen->debut=$request->hd;
        $debut = Carbon::createFromFormat('H:i:s', $examen->debut);
        $fin = Carbon::createFromFormat('H:i:s', $epreuve->duree);
        $examen->fin = $debut->addMinutes($fin->minute)->addHours($fin->hour);

        if($request->calculatrice == null)
        {
            $examen->calculatrice = 0;
        }
        else
        {
            $examen->calculatrice = $request->calculatrice;
        }

        if($request->dictionnaire == null)
        {
            $examen->dictionnaire = 0;
        }
        else
        {
            $examen->dictionnaire =$request->dictionnaire;
        }

        $examen->save();
        return redirect()->route('examens.index')->with('success', 'Examens modifié avec succès.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $examen = Examen::find($id);
        $examen->delete();
        return redirect()->route("examens.index")->with("success","Examen bien supprimé !");
    }

    public function examensSearch(Request $request)
    {
        $examens = Examen::all();
        $epreuves = Epreuve::all();
        $formations = Formation::all();
        $salles = Salle::all();
        $examensSearch = [];

        foreach($examens as $lignes)
        {
            if($lignes->formation->nom == $request->recherche)
            {
                array_push($examensSearch, $lignes);
            }
            else if( $lignes->epreuve->matiere == $request->recherche)
            {
                array_push($examensSearch, $lignes);
            }
        }
        return view("examens",compact("examensSearch","epreuves","formations","salles","request"));
    }

    public function epreuveFormations($id)
    {
        $this->middleware('cors');
        $formations = Epreuve::find($id)->formations;
        return response()->json($formations);
    }

    public function epreuvesSearch($matiere)
    {
        $epreuves = Epreuve::Where('matiere',"=".$matiere)->get();
        return response()->json($epreuves);
    }
}
