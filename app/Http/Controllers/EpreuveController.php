<?php

namespace App\Http\Controllers;

use App\Models\Epreuve;
use App\Models\Examen;
use App\Models\Formation;
use App\Models\Salle;
use Illuminate\Http\Request;
use DateTime;

class EpreuveController extends Controller
{
    public function __construct()
    {
    $this->middleware('isadmin');
    $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $epreuves = Epreuve::paginate(5);
        $salles = Salle::all();
        $formations = Formation::all();
        return view('epreuves',compact('epreuves','salles','formations'));
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
        if(isset($request->matiere))
        {
            $epreuve->matiere = $request->matiere;
        }
        $epreuve->debut = DateTime::createFromFormat("H:i", $request->debut);
        $epreuve->fin = DateTime::createFromFormat("H:i", $request->fin);
        $epreuve->loge = DateTime::createFromFormat("H:i", $request->loge);
        if($epreuve->save()){

                session()->flash('success', 'Épreuve créée');
                return redirect()->route('epreuves.index');
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
        $epreuve = epreuve::find($id);
        $salles = Salle::all();
        $formations = Formation::all();
        return view('epreuve-show',compact('epreuve','salles','formations'));
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
        $epreuve = Epreuve::find($id);

        if(isset($request->matiere))
        {
            $epreuve->matiere = $request->matiere;
        }
        $epreuve->debut = DateTime::createFromFormat("H:i", $request->debut);
        $epreuve->fin = DateTime::createFromFormat("H:i", $request->fin);
        $epreuve->loge = DateTime::createFromFormat("H:i", $request->loge);

        if($epreuve->save()){

            session()->flash('success', 'Épreuve modifiée');
            return redirect()->route('epreuves.index');

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
        $examen = Examen::find($id);
        $epreuve = Epreuve::find($examen->epreuve->id);
        if($examen->delete())
        {
            $epreuve->delete();
            session()->flash('success', 'Épreuve supprimée');
            return redirect()->route('epreuves.index');
        }

    }
}
