<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Type_Vehicule;
use App\Models\Vehicule;
use Illuminate\Http\Request;

class VehiculeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        return view('pages.vehicule.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data=[];
        $data["vehicule"]= Vehicule::all();
        $vehicule= Vehicule::all();
        $data["type_vehicule"]= Type_Vehicule::all();
        $data["client"]= Client::all();
        return view('pages.vehicule.create',compact('data'));
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       

              $this->validate($request, [
               
          
          'id' => '',
          'matricule'=> 'required',
          'couleur' => 'required',
          'marque' => 'required',
          'model' => 'required', 
          'type_vehicule_id' => 'required',
          'client_id' => 'required',
       
             ]);

          $vehicule = new Vehicule([
        
          'id' => $request->get(''),
          'matricule' => $request->get('matricule'),
          'couleur' => $request->get('couleur'),
          'marque' => $request->get('marque'),
          'model' => $request->get('model'),
          'type_vehicule_id' => $request->get('type_vehicule_id'),
          'client_id' => $request->get('client_id'),
        
          ]);


          $vehicule->save();
          return redirect('/vehicule')->with('success', 'type de vehicule Ajouté avec succès');
   }


    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vehicule = Vehicule::findOrFail($id);
        return view('pages.vehicule.show', compact('vehicule'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $vehicule= Vehicule::findOrFail($id);
        return view('pages.vehicule.edit', compact('vehicule'));
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
            
            'matricule'=> 'required',
            'couleur' => 'required',
            'marque' => 'required',
            'model' => 'required',
            'type_vehicule_id' => 'required',
            'client_id'=> 'required',

        ]);

        $vehicule = Vehicule::findOrFail($id);
        $vehicule->matricule = $request->get('matricule');
        $vehicule->couleur = $request->get('couleur');
        $vehicule->marque = $request->get('marque');
        $vehicule->model = $request->get('model');
        $vehicule->type_vehicule_id = $request->get('type_vehicule_id');
        $vehicule->client_id = $request->get('client_id');


        $vehicule->update();

        return redirect('/vehicule')->with('success', 'vehicule Modifié avec succès');

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vehicule = Vehicule::findOrFail($id);
        $vehicule->delete();
        return redirect('/vehicule')->with('success', 'vehicule Modifié avec succès');
    }
}

