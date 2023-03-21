<?php

namespace App\Http\Controllers;

use App\Models\Capteur;
use App\Models\Place_Stationnement;
use App\Models\Parking;
use App\Models\Type_Vehicule;
use Illuminate\Http\Request;

class Place_StationnementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        
        return view('pages.Place_Stationnement.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $data=[];
        $data["place_stationnement"]= Place_Stationnement::all();
        $place_stationnement= Place_Stationnement::all();
        $data["type_vehicule"]= Type_Vehicule::all();
        $data["parking"]= Parking::all();
        $data["capteur"]= Capteur::all();
        return view('pages.place_stationnement.create',compact('data'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'id'=>'',
            'libelle'=> 'required',
            'etat' => 'required',
            'numero' => 'required',
            'parking_id' => 'required',
        ]);


        $place_stationnement = new Place_Stationnement([
            'id' => $request->get(''),
            'libelle' => $request->get('libelle'),
            'etat' => $request->get('etat'),
            'numero' => $request->get('numero'),
            'parking_id' => $request->get('parking_id'),
            
        ]);


        $place_stationnement->save();
        return redirect('/place_stationnement')->with('success', 'Place stationnement Ajouté avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        return view('pages.place_stationnement.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        

        return view('pages.place_stationnement.edit');
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
        $request->validate([

            'id'=>'',
            'libelle'=> 'required',
            'etat' => 'required',
            'numero' => 'required',
            'parking_id' => 'required',

        ]);




        $place_stationnement = Place_Stationnement::findOrFail($id);
        $place_stationnement->id = $request->get('');
        $place_stationnement->libelle = $request->get('libelle');
        $place_stationnement->etat = $request->get('etat');
        $place_stationnement->numero = $request->get('numero');
        $place_stationnement->parking_id = $request->get('parking_id');


        $place_stationnement->update();

        return redirect('/place_stationnement')->with('success', 'Place stationnement Modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        $place_stationnement = Place_Stationnement::findOrFail($id);
        $place_stationnement->delete();

        return redirect('/place_stationnement')->with('success', 'place stationnement Modifié avec succès');
    }
}
