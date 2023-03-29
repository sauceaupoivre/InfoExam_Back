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
        return view('epreuves');
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
        if(isset($request->matiere))
        {
            $epreuve->matiere = $request->matiere;
        }
        $epreuve->description = $request->description;
        $epreuve->duree = DateTime::createFromFormat("H:i", $request->duree);
        $epreuve->loge = DateTime::createFromFormat("H:i", $request->loge);
        if($epreuve->save()){
            if(is_array($request->formations)){
                foreach($request->formations as $formation){
                    $f = Formation::find($formation);
                    $epreuve->formations()->attach($f);
            }
            }
            session()->flash('success', 'Épreuve créée');
        }
        else{
            session()->flash('error', 'Erreur');
            $epreuve->delete();
        }
        return redirect()->route('epreuves.index');
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

        $epreuve->examen_concours = $request->examen_concours;
        $epreuve->epreuve = $request->epreuve;
        if(isset($request->matiere))
        {
            $epreuve->matiere = $request->matiere;
        }
        $epreuve->duree = DateTime::createFromFormat("H:i", $request->duree);
        $epreuve->loge = DateTime::createFromFormat("H:i", $request->loge);

        $epreuve->formations()->sync($request->formations);

        if($epreuve->save()){

            session()->flash('success', 'Épreuve modifiée');

        }else{
            session()->flash('error', 'Érreur');

        }
        return redirect()->route('epreuves.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $epreuve = Epreuve::find($id);
        try
        {
            $formation->delete();
            return redirect()->route('epreuves.index')->with('success', 'Epreuve supprimer avec succès.');

        } catch (\Throwable $th)
        {
            return redirect()->route('epreuves.index')->with('error', 'Cette epreuve est utilisée par un examen');
        }


    }
}
