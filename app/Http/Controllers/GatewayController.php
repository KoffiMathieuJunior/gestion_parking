<?php

namespace App\Http\Controllers;

use App\Models\Gateway;
use App\Models\Parking;
use Illuminate\Http\Request;

class GatewayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $gateway = Gateway::all();
        return view('pages.gateway.index', compact('gateway'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $parking = Parking::all();
        return view('pages.gateway.create', compact('parking'));
        
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
            'host'=> 'required',
            'mot_passe'=> 'required',
            'parking_id'=> 'required',
            
        ]);


        $gateway = new Gateway([
            'id' => $request->get(''),
            'code' => $request->get('code'),
            'libelle' => $request->get('libelle'),
            'host' => $request->get('host'),
            'mot_passe' => $request->get('mot_passe'),
            'parking_id' => $request->get('parking_id'),
            
        ]);


        $gateway->save();
        return redirect('/gateway')->with('success', 'gateway Ajouté avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $gateway = Gateway::findOrFail($id);
        return view('pages.gateway.show', ['gateway' => $gateway]);
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gateway = Gateway::findOrFail($id);
        return view('pages.gateway.edit', compact('gateway'));
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
            'code'=> 'required',
            'libelle' => 'required',
            'host' => 'required',
            'mot_passe' => 'required',
            'parking_id' => 'required',
            

        ]);




        $gateway = Gateway::findOrFail($id);
        $gateway->id = $request->get('');
        $gateway->code = $request->get('code');
        $gateway->libelle = $request->get('libelle');
        $gateway->host = $request->get('host');
        $gateway->mot_passe = $request->get('mot_passe');
        $gateway->parking_id = $request->get('parking_id');


        $gateway->update();

        return redirect('/gateway')->with('success', 'gateway Modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $gateway = Gateway::findOrFail($id);
        $gateway->delete();

        return redirect('/gateway')->with('success', 'gateway Modifié avec succès');
    }
}
