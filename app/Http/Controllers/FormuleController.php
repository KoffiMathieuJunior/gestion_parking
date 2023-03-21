<?php

namespace App\Http\Controllers;

use App\Models\Formule;
use Illuminate\Http\Request;

class FormuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $formule = Formule::all();
        return view('pages.formule.index', compact('formule'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.formule.create');

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


        $formule = new Formule([
            'code' => $request->get('code'),
            'libelle' => $request->get('libelle'),
            
        ]);


        $formule->save();
        return redirect('/formule')->with('success', 'formule ajouté avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $formule = Formule::findOrFail($id);
        return view('pages.formule.show', ['formule' => $formule]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $formule= Formule::findOrFail($id);
        return view('pages.formule.edit', compact('formule'));
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
            'libelle' => 'required',

        ]);




        $formule = Formule::findOrFail($id);
        
        $formule->code = $request->get('code');
        $formule->libelle = $request->get('libelle');

        $formule->update();

        return redirect('/formule')->with('success', 'formule Modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        $formule = Formule::findOrFail($id);
        $formule->delete();

        return redirect('/formule')->with('success', 'Formule Modifié avec succès');
    }
}
