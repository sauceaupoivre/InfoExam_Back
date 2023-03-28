<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formation;

class FormationController extends Controller
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
        $formations = Formation::all();
        return view('formations', compact('formations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $formation = new Formation();
        $formation->nom = $request->nom;
        $formation->serie = $request->numeros;
        $formation->academie = $request->academie;
        $formation->save();
        return redirect()->back()->with('success', 'La formation a vien été créee.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $formation = Formation::find($id);
        $données = $request;
        $formation->nom = $données->nom;
        $formation->serie = $données->numeros;
        $formation->academie = $données->academie;
        $formation->save();
        return redirect()->back()->with('success', 'La formation a été modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $formation = Formation::find($id);
        try {
            $formation->delete();
                return redirect()->route('formations.index')->with('success', 'Formation modifiée avec succès.');

        } catch (\Throwable $th) {
            return redirect()->route('formations.index')->with('error', 'Cette formation est utilisée par une épreuve');
        }
    }

    public function formationsSearch(Request $request)
    {
        $formations = Formation::all();
        $formationsSecond = [];
        foreach($formations as $ligne)
        {
            if($lignes->SIO == $request->recherche )
            {
                array_push($formationsSecond, $lignes);
            }
            elseif($lignes->academie == $request->recherche)
            {
                array_push($formationsSecond, $lignes);
            }
        }

        return view("formations",comapct("formationsSecond"));
    }
}
