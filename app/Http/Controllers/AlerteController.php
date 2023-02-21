<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alerte;
use App\Models\Salle;
use Illuminate\Console\View\Components\Alert;

class AlerteController extends Controller
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
        $alertes = Alerte::all();
        return view('alertes', compact('alertes'));
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

        try {
            $a = new Alerte;
            $a->titre = $request->titre;
            $a->description = $request->description;
            $a->examen_id = $request->epreuves;

            $a->save();

            session()->flash('success', 'Alerte envoyée');
        } catch (\Throwable $th) {
            session()->flash('error', "Erreur lors de l'envoi de l'alerte");
            //throw $th;
        }
        return redirect()->route('alertes.index');
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
        //
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
