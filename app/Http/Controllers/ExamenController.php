<?php

namespace App\Http\Controllers;

use App\Models\Examen;
use App\Models\Epreuve;
use Illuminate\Http\Request;
use DateTime;

class ExamenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $epreuve = new Epreuve;
        $epreuve->examen_concours = $request->examen_concours;
        $epreuve->epreuve = $request->epreuve;
        $epreuve->session = $request->session;
        if(isset($request->matiere))
        {
            $epreuve->matiere = $request->matiere;
        }
        $epreuve->debut = DateTime::createFromFormat("H:i", $request->debut);
        $epreuve->fin = DateTime::createFromFormat("H:i", $request->fin);
        $epreuve->loge = DateTime::createFromFormat("H:i", $request->loge);
        if($epreuve->save()){
            $examen = new Examen;
            $examen->estdematerialise = $request->estdematerialise;
            if(isset($request->calculatrice))
            {
                $examen->calculatrice = $request->calculatrice;
            }
            if(isset($request->dictionnaire))
            {
                $examen->dictionnaire = $request->dictionnaire;
            }
            $examen->date = $request->date;
            $examen->salle_id = $request->salle;
            $examen->formation_id = $request->formation;
            $examen->epreuve_id = $epreuve->id;
            if($examen->save()){
                session()->flash('success', 'Épreuve créée');
                return redirect()->route('epreuves.index');
            }
        }
        else{
            $epreuve->delete();
        }
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

        $epreuve->examen_concours = $request->examen_concours;
        $epreuve->epreuve = $request->epreuve;
        $epreuve->session = $request->session;
        if(isset($request->matiere))
        {
            $epreuve->matiere = $request->matiere;
        }
        $epreuve->debut = DateTime::createFromFormat("H:i", $request->debut);
        $epreuve->fin = DateTime::createFromFormat("H:i", $request->fin);
        $epreuve->loge = DateTime::createFromFormat("H:i", $request->loge);

        if($epreuve->save()){
            $examen->estdematerialise = $request->estdematerialise;
            if(isset($request->calculatrice))
            {
                $examen->calculatrice = $request->calculatrice;
            }
            if(isset($request->dictionnaire))
            {
                $examen->dictionnaire = $request->dictionnaire;
            }
            $examen->date = $request->date;
            $examen->salle_id = $request->salle;
            $examen->formation_id = $request->formation;
            if($examen->save()){
                session()->flash('success', 'Épreuve modifiée');
                return redirect()->route('epreuves.index');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
