<?php

namespace App\Http\Controllers;

use App\Models\Capteur;
use App\Models\Gateway;
use App\Models\Statut;
use Illuminate\Http\Request;

class CapteurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        
      return view('pages.capteur.index');  
       
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

      $data=[];
      $data["capteur"] = Capteur::all();
      $capteur = Capteur::all();
      $data["statut"] = Statut::all();
      $data["gateway"] = Gateway::all();
      return view('pages.capteur.create',compact('data')); 

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
               
          
           
            'libelle'=> 'required',
            'etat' => 'required',
            'statut_id' => 'required',
            'gateway' => 'required', 
           
        ]);

        $capteur = new Capteur([
        
            
            'libelle' => $request->get('libelle'),
            'etat' => $request->get('etat'),
            'statut_id' => $request->get('statut_id'),
            'gateway_id' => $request->get('gateway_id'),
           
          
            ]);
            $capteur->save();
            return redirect('/capteur')->with('success', 'type de vehicule Ajouté avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        return view('pages.capteur.show', compact('capteur'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       

        return view('pages.capteur.edit',);
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
            'statut_id' => 'required',
            'gateway_id' => 'required'
        ]);




        $capteur = Capteur::findOrFail($id);
        $capteur->id = $request->get('');
        $capteur->libelle = $request->get('libelle');
        $capteur->etat = $request->get('etat');
        $capteur->gateway_id = $request->get('statut_id');
        $capteur->gateway_id = $request->get('gateway_id');



        $capteur->update();
        return redirect('/capteur')->with('success', 'Capteur Modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        return redirect('/capteur')->with('success', 'capteur Modifié avec succès');
    }
}
