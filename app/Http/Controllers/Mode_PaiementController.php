<?php

namespace App\Http\Controllers;

use App\Models\Mode_Paiement;
use Illuminate\Http\Request;

class Mode_PaiementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        
        return view('pages.mode_paiement.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.mode_paiement.create');

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


        $mode_paiement= new Mode_Paiement([
            'id' => $request->get(''),
            'code' => $request->get('code'),
            'libelle' => $request->get('libelle'),
        ]);


        $mode_paiement->save();
        return redirect('/mode_paiement')->with('success', 'mode de paiment Ajouté avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mode_paiement = Mode_Paiement::findOrFail($id);
        return view('pages.mode_paiement.show', ['mode_paiement' => $mode_paiement]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    
        $mode_paiement= Mode_Paiement::findOrFail($id);
        return view('pages.mode_paiement.edit', compact('mode_paiement'));
       
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




        $mode_paiement = Mode_Paiement::findOrFail($id);
        $mode_paiement->code = $request->get('code');
        $mode_paiement->libelle = $request->get('libelle');


        $mode_paiement->update();

        return redirect('/mode_paiement')->with('success', 'mode paiement Modifié avec succès');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        $mode_paiement = Mode_Paiement::findOrFail($id);
        $mode_paiement->delete();

        return redirect('/mode_paiement')->with('success', 'mode paiement Modifié avec succès');
    }
}
