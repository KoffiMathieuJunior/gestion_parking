<?php

namespace App\Http\Controllers;

use App\Models\compagnie;
use App\Models\Parking;
use Illuminate\Http\Request;

class ParkingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $parking = Parking::all();
        return view('pages.parking.index', compact('parking'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $compagnie = compagnie::all();
        return view('pages.parking.create', compact('compagnie'));
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
            'latitude' => 'required',
            'longitude' => 'required',
            'adresse' => 'required',
            'heure_ouverture' => 'required',
            'heure_fermeture' => 'required',
            'compagnie_id' => 'required',
        ]);


        $parking = new Parking([
            'id' => $request->get(''),
            'libelle' => $request->get('libelle'),
            'latitude' => $request->get('latitude'),
            'longitude' => $request->get('longitude'),
            'adresse' => $request->get('adresse'),
            'heure_ouverture' => $request->get('heure_ouverture'),
            'heure_fermeture' => $request->get('heure_fermeture'),
            'compagnie_id' => $request->get('compagnie_id'),
        ]);


        $parking->save();
        return redirect('/parking')->with('success', 'Parking Ajouté avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $parking = Parking::findOrFail($id);
        return view('pages.parking.show', ['parking' => $parking]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      
        $parking= Parking::findOrFail($id);
        return view('pages.parking.edit', compact('parking'));

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
            'latitude' => 'required',
            'longitude' => 'required',
            'adresse' => 'required',
            'heure_ouverture' => 'required',
            'heure_fermeture' => 'required',
            'compagnie_id' => 'required',

        ]);




        $parking = Parking::findOrFail($id);
        $parking->id = $request->get('');
        $parking->libelle = $request->get('libelle');
        $parking->latitude = $request->get('latitude');
        $parking->longitude = $request->get('longitude');
        $parking->adresse = $request->get('adresse');
        $parking->heure_ouverture = $request->get('heure_ouverture');
        $parking->heure_fermeture = $request->get('heure_fermeture');
        $parking->compagnie_id = $request->get('compagnie_id');
        $parking->update();

        return redirect('/parking')->with('success', 'parking Modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $parking = Parking::findOrFail($id);
        $parking->delete();

        return redirect('/parking')->with('success', 'Parking Modifié avec succès');
    }
}
