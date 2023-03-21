<?php

namespace App\Http\Controllers;

use App\Models\Type_Vehicule;
use Illuminate\Http\Request;

class Type_VehiculeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $type_vehicule = Type_Vehicule::all();
        return view('pages.type_vehicule.index', compact('type_vehicule'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.type_vehicule.create');
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
            
            'code'=> 'required',
            'libelle' => 'required', 
           
        ]);


        $type_vehicule = new Type_Vehicule([
            
            'code' => $request->get('code'),
            'libelle' => $request->get('libelle'),
            
        ]);


        $type_vehicule->save();
        return redirect('/type_vehicule')->with('success', 'type de vehicule Ajouté avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $type_vehicule = Type_Vehicule::findOrFail($id);
        return view('pages.type_vehicule.show', ['type_vehicule' => $type_vehicule]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)

    {
    
         $type_vehicule= Type_Vehicule::findOrFail($id);
        return view('pages.type_vehicule.edit', compact('type_vehicule'));

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
          
            'code'=> 'required',
            'libelle' => 'required'

        ]);

        $type_vehicule = Type_Vehicule::findOrFail($id);
        $type_vehicule->code = $request->get('code');
        $type_vehicule->libelle = $request->get('libelle');
        $type_vehicule->update();

        return redirect('/type_vehicule')->with('success', 'Type de vehicule Modifié avec succès');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type_vehicule = Type_Vehicule::findOrFail($id);
        $type_vehicule->delete();

        return redirect('/type_vehicule')->with('success', ' supprimé avec succès');

    }
}
