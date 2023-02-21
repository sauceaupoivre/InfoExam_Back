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
    public function index()
    {
        try {
            $cartouches = Examen::with('salle','alertes','formation','epreuve')->get();
            return response()->json($cartouches);
        } catch (\Throwable $th) {
            //throw $th;
        }
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
        try {
            $examen = Examen::find($id);
            return response()->json($examen->load('salle','alertes','formation','epreuve'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function showByDate($date)
    {
        try {
            $examens = Examen::where('date','LIKE','%'.$date.'%')->get();
            return response()->json($examens->load('salle','alertes','formation','epreuve'));
        } catch (\Throwable $th) {
            //throw $th;
        }

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
