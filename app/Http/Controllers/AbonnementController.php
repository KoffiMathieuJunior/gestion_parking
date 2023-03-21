<?php

namespace App\Http\Controllers;

use App\Models\Abonnement;
use Illuminate\Http\Request;

class AbonnementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $abonnement = Abonnement::all();
        return view('pages.abonnement.index', compact('abonnement'));
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.abonnement.create');
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
            'date_abonnement' => 'required',
            'libelle' => 'required',
        ]);
        $abonnement = new Abonnement([
            'code' => $request->get('code'),
            'date_abonnement' => $request->get('date_abonnement'),
            'libelle' => $request->get('libelle'),
        ]);


        $abonnement->save();
        return redirect('/abonnement')->with('success', 'Abonnement effectué avec succès');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $abonnement = Abonnement::findOrFail($id);
        return view('pages.abonnement.show', ['abonnement' => $abonnement]);
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $abonnement = Abonnement::findOrFail($id);
        return view('pages.abonnement.edit', compact('abonnement'));
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
            'date_abonnement'=> 'required',
            'libelle' => 'required',
        ]);

        

        $abonnement = Abonnement::findOrFail($id);
        $abonnement->code = $request->get('code');
        $abonnement->date_abonnement = $request->get('date_abonnement');
        $abonnement->libelle = $request->get('libelle');

        $abonnement->update();

        return redirect('/abonnement')->with('success', 'Abonnement Modifié avec succès');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $abonnement = Abonnement::findOrFail($id);
        $abonnement->delete();

        return redirect('/abonnement')->with('success', 'Abonnement supprimé avec succès');
    }
}
