<?php

namespace App\Http\Controllers;

use App\Models\Proprietaire;
use App\Models\Type_Proprietaire;
use Illuminate\Http\Request;

class ProprietaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proprietaire = Proprietaire::all();
        return view('pages.proprietaire.index', compact('proprietaire'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type_proprietaire = Type_Proprietaire::all();
        return view('pages.proprietaire.create', compact('type_proprietaire'));
        
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
            'id' => '', 
            'libelle' => 'required', 
            'contact'=> 'required',
            'email'=> 'required',
            'date_inscription'=> 'required',
            'logo'=> 'required',
            'type_proprietaire_id'=> 'required',
           
        ]);


        $proprietaire = new Proprietaire([
            
            'id' => $request->get(''),
            'libelle' => $request->get('libelle'),
            'contact' => $request->get('contact'),
            'email' => $request->get('email'),
            'date_inscription' => $request->get('date_inscription'),
            'logo' => $request->get('logo'),
            'type_proprietaire_id' => $request->get('type_proprietaire_id'),
            
        ]);


        $proprietaire->save();
        return redirect('/proprietaire')->with('success', 'Ajouté avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $proprietaire = Proprietaire::findOrFail($id);
        return view('pages.proprietaire.show', ['proprietaire' => $proprietaire]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proprietaire= Proprietaire::findOrFail($id);
        return view('pages.proprietaire.edit', compact('proprietaire'));
       
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
          
            'libelle'=> 'required',
            'contact' => 'required',
            'email' => 'required',
            'date_inscription' => 'required',
            'logo' => 'required',
            'type_proprietaire_id' => 'required'

        ]);

        $proprietaire = Proprietaire::findOrFail($id);
        $proprietaire->libelle = $request->get('libelle');
        $proprietaire->contact = $request->get('contact');
        $proprietaire->email = $request->get('email');
        $proprietaire->date_inscription = $request->get('date_inscription');
        $proprietaire->logo = $request->get('logo');
        $proprietaire->type_proprietaire_id = $request->get('type_proprietaire_id');
        $proprietaire->update();

        return redirect('/proprietaire')->with('success', 'Modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $proprietaire = Proprietaire::findOrFail($id);
        $proprietaire->delete();

        return redirect('/proprietaire')->with('success', ' supprimé avec succès');
    }
}
