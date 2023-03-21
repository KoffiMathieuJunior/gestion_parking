<?php

namespace App\Http\Controllers;

use App\Models\Abonnement;
use App\Models\Client;
use App\Models\client as ModelsClient;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
      
        return view('pages.client.index');
        

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        $data=[];
        $data["client"]= Client::all();
        $client= Client::all();
        $data["abonnement"]= Abonnement::all();
        
        return view('pages.client.create',compact('data'));
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

            'id'=> '',
            'nom' => 'required',
            'prenoms' => 'required',
            'code' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'mot_passe' => 'required',
            'abonnement_id' => 'required',
        ]);
        $client = new Client([
            'id' => $request->get(''),
            'nom' => $request->get('nom'),
            'prenoms' => $request->get('prenoms'),
            'code' => $request->get('code'),
            'phone' => $request->get('phone'),
            'email' => $request->get('email'),
            'mot_passe' => $request->get('mot_passe'),
            'abonnement_id' => $request->get('abonnement_id'),
        ]);


        $client->save();
        return redirect('/client')->with('success', 'Abonnement effectué avec succès');
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client$client)
    {
        return view('pages.client.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $client = Client::findOrFail($id);
        return view('pages.client.edit', compact('client'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([

            
            'nom'=> 'required',
            'prenoms'=> 'required',
            'code'=> 'required',
            'phone'=> 'required',
            'email'=> 'required',
            'mot_passe'=> 'required',
            'abonnement_id'=> 'required',

        ]);
        $client = Client::findOrFail($id); 

        $client->nom = $request->post('nom');
        $client->prenoms = $request->post('prenoms');
        $client->code = $request->post('code');
        $client->phone = $request->post('phone');
        $client->email = $request->post('email');
        $client->mot_passe = $request->post('mot_passe');
        $client->abonnement_id = $request->post('abonnement_id');
        $client->update();

        return redirect('/client')->with('success', 'Client Modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        return redirect('/client')->with('success', 'client supprimé avec succès');

    }
}
