<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alerte;
use App\Models\Examen;
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
        $examens = Examen::where('salle_id',$request->salle)->get();

        foreach($examens as $examen){
            $alert = new Alerte;
            $alert->titre = $request->titre;
            $alert->description = $request->description;
            $alert->examen_id = $examen->id;
            //pdf
            if($request['pdf'] != null){
                $pdf = $request->file('pdf');
                $input['file'] = $pdf->getClientOriginalName();
                $destinationPath = public_path('/pdf');
                $alert->pdf = $input['file'];
            }
            if($alert->save()){
                continue;
            }else{
                break;
                session()->flash('error', "Erreur lors de l'envoi de l'alerte");
                return redirect()->route('alertes.index');
            }
        }
        if(isset($pdf)){$pdf->move($destinationPath, $input['file']);}
        session()->flash('success', 'Alerte(s) envoyée(s)');
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
