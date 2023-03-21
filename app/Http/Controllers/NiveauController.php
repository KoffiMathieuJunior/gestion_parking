<?php

namespace App\Http\Controllers;

use App\Models\Niveau;
use Illuminate\Http\Request;

class NiveauController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $niveau = Niveau::all();
        return view('pages.niveau.index', compact('niveau'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.niveau.create');

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
            'code'=> 'required',
            'libelle' => 'required',

        ]);


        $niveau = new Niveau([
            'id' => $request->get(''),
            'code' => $request->get('code'),
            'libelle' => $request->get('libelle'),
        ]);


        $niveau->save();
        return redirect('/niveau')->with('success', 'niveau Ajouté avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $niveau = Niveau::findOrFail($id);
        return view('pages.niveau.show', ['niveau' => $niveau]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $niveau= Niveau::findOrFail($id);
        return view('pages.niveau.edit', compact('niveau'));
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




        $niveau = Niveau::findOrFail($id);
       
        $niveau->code = $request->get('code');
        $niveau->libelle = $request->get('libelle');


        $niveau->update();

        return redirect('/niveau')->with('success', 'niveau Modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        $niveau = Niveau::findOrFail($id);
        $niveau->delete();

        return redirect('/niveau')->with('success', 'niveau Modifié avec succès');
    }
}
