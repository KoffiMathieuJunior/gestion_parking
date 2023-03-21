<?php

namespace App\Http\Controllers;

use App\Models\Statut;
use Illuminate\Http\Request;

class StatutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         
        $statut = Statut::all();
        return view('pages.statut.index', compact('statut'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.statut.create');
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


        $statut = new Statut([
            
            'code' => $request->get('code'),
            'libelle' => $request->get('libelle'),
            
        ]);


        $statut->save();
        return redirect('/statut')->with('success', 'type de vehicule Ajouté avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $statut = Statut::findOrFail($id);
        return view('pages.statut.show', ['statut' => $statut]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $statut= Statut::findOrFail($id);
        return view('pages.statut.edit', compact('statut'));

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

        $statut = Statut::findOrFail($id);
        $statut->code = $request->get('code');
        $statut->libelle = $request->get('libelle');
      
        $statut->update();

        return redirect('/statut')->with('success', 'Type de vehicule Modifié avec succès');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $statut = Statut::findOrFail($id);
        $statut->delete();

        return redirect('/statut')->with('success', ' supprimé avec succès');
    }
}
