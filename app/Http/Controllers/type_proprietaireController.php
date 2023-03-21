<?php

namespace App\Http\Controllers;

use App\Models\Type_Proprietaire;
use Illuminate\Http\Request;

class type_proprietaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $type_proprietaire = Type_Proprietaire::all();
        return view('pages.type_proprietaire.index', compact('type_proprietaire'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.type_proprietaire.create');
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


        $type_proprietaire = new Type_Proprietaire([
            
            'code' => $request->get('code'),
            'libelle' => $request->get('libelle'),
            
        ]);


        $type_proprietaire->save();
        return redirect('/type_proprietaire')->with('success', 'Ajouté avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $type_proprietaire = Type_Proprietaire::findOrFail($id);
        return view('pages.type_proprietaire.show', ['type_proprietaire' => $type_proprietaire]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $type_proprietaire= Type_Proprietaire::findOrFail($id);
        return view('pages.type_proprietaire.edit', compact('type_proprietaire'));

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

        $type_proprietaire = Type_Proprietaire::findOrFail($id);
        $type_proprietaire->code = $request->get('code');
        $type_proprietaire->libelle = $request->get('libelle');
      
        $type_proprietaire->update();

        return redirect('/type_proprietaire')->with('success', 'Modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type_proprietaire = Type_Proprietaire::findOrFail($id);
        $type_proprietaire->delete();

        return redirect('/type_proprietaire')->with('success', ' supprimé avec succès');
    }
}
