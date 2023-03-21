<?php

namespace App\Http\Controllers;

use App\Models\Formule;
use App\Models\Mode_Paiement;
use App\Models\Place_Stationnement;
use App\Models\Reservation;
use App\Models\Client;

use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        
        return view('pages.reservation.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data=[];
        $reservation= Reservation::all();
        $data["reservation"]= Reservation::all();
        $data["place_stationnement"]= Place_Stationnement::all();
        $data["formule"]= Formule::all();
        $data["client"]= Client::all(); 
        $data["mode_paiement"]= Mode_Paiement::all();
        
        return view('pages.reservation.create',compact('data'));

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
            'date_reservation'=> 'required',
            'palce_id' => 'required',
            'duree_reservation' => 'required',
            'formule_id' => 'required',
            'client_id' => 'required',
            'mode_paiement_id' => 'required',
        ]);


        $reservation = new Reservation([
            'id' => $request->get(''),
            'date_reservation' => $request->get('date_reservation'),
            'place_id' => $request->get('place_id'),
            'duree_reservation' => $request->get('duree_reservation'),
            'formule_id' => $request->get('formule_id'),
            'client_id' => $request->get('client_id'),
            'mode_paiement_id' => $request->get('mode_paiement_id'),
        ]);


        $reservation->save();
        return redirect('/reservation')->with('success', 'reservation Ajouté avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    
        return view('pages.reservation.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        return view('pages.reservation.edit');
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
            'date_reservation'=> 'required',
            'palce_id' => 'required',
            'duree_reservation' => 'required',
            'formule_id' => 'required',
            'client_id' => 'required',
            'mode_paiement_id' => 'required',

        ]);




        $reservation = Reservation::findOrFail($id);
        $reservation->id = $request->get('');
        $reservation->date_reservation = $request->get('date_reservation');
        $reservation->place_id = $request->get('place_id');
        $reservation->duree_reservation = $request->get('duree_reservation');
        $reservation->formule_id = $request->get('formule_id');
        $reservation->client_id = $request->get('client_id');


        $reservation->update();

        return redirect('/reservation')->with('success', 'reservation Modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return redirect('/reservation')->with('success', 'reservation Modifié avec succès');
    }
}
