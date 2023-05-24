<?php

namespace App\Http\Controllers;

use App\Models\Abonnement;
use Illuminate\Http\Request;
use App\Http\Requests\AbonnementRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController;

class AbonnementController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $abonnement = Abonnement::paginate(10);
        return view('pages.abonnement.index', compact('abonnement'));
    }

    /** 
     * 
     * 
    */
    public function getAbonnement(Request $request){
        // dd($request->all()['size']);
        $req = $request->all();
        $data = Abonnement::paginate($req['size']);
        return $this->sendResponse($data, 'Opération effectuée avec succès.');
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
        // return $this->sendResponse($abonnement, 'Opération effectuée avec succès.');
        return redirect('/abonnement')->with('success', 'Abonnement effectué avec succès');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createAbonnement(Request $request)
    {
        // dd($request->all());
        $req = $request->all();
        // echo "Before Validator::make<br>";
        $validator = Validator::make($req, [
            'data' => 'required|array',
            'data.code' => 'required|string',
            'data.libelle' => 'required|string',
            'data.client_id' => 'required|string',
            'data.place_stationnements_id' => 'required|string',
            'data.date_debut' => 'required|date_format:d/m/Y',
            'data.date_fin' => 'required|date_format:d/m/Y',
            'data.statut' => 'required|string',
        ]);
        echo "After Validator::make<br>";
        if($validator->passes()){
            // echo "passe <br>".$$req['data'];
            // dd($validator);
            $abonnement = new Abonnement([
                'code' => $req['data']['code'],
                'libelle' =>  $req['data']['libelle'],
                'client_id' =>  $req['data']['client_id'],
                'place_stationnements_id' =>  $req['data']['client_id'],
                'date_debut' => $req['data']['date_debut'],
                'date_fin' => $req['data']['date_fin'],
                'statut' => $req['data']['statut'],
            ]);
    
            $abonnement->save();
            return $this->sendResponse($abonnement, 'Opération effectuée avec succès.');
        } else {
            // dd('validation');
            return $this->sendError($validator->errors()->all(), 'Operation echouée');
        }
       
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
    public function update(Request $request)
    {
        $req = $request->all();
        // echo "Before Validator::make<br>";
        $validator = Validator::make($req, [
            'data' => 'required|array',
            'data.id' => 'required',
            'data.code' => 'required|string',
            'data.libelle' => 'required|string',
            'data.client_id' => 'required|string',
            'data.place_stationnements_id' => 'required|string',
            'data.date_debut' => 'required|date_format:d/m/Y',
            'data.date_fin' => 'required|date_format:d/m/Y',
            'data.statut' => 'required|string',
        ]);

        if($validator->passes()){
            // echo "passe <br>".$$req['data'];
            // dd($validator);
            // $abonnement = new Abonnement([
            //     'id' => $req['data']['id'],
            //     'code' => $req['data']['code'],
            //     'libelle' =>  $req['data']['libelle'],
            //     'client_id' =>  $req['data']['client_id'],
            //     'place_stationnements_id' =>  $req['data']['client_id'],
            //     'date_debut' => $req['data']['date_debut'],
            //     'date_fin' => $req['data']['date_fin'],
            //     'statut' => $req['data']['statut'],
            // ]);
        
            $abonnement = Abonnement::findOrFail($req['data']['id']);
            $abonnement->id = $req['data']['id'];
            $abonnement->code = $req['data']['code'];
            $abonnement->date_abonnement = $req['data']['date_abonnement'];
            $abonnement->libelle = $req['data']['libelle'];
            $abonnement->client_id = $req['data']['client_id'];
            $abonnement->place_stationnements_id = $req['data']['place_stationnements_id'];
            $abonnement->date_debut = $req['data']['date_debut'];
            $abonnement->date_fin = $req['data']['date_fin'];
            $abonnement->statut = $req['data']['statut'];
            $abonnement->update();
            $abonnement->save();
            return $this->sendResponse($abonnement, 'Opération effectuée avec succès.');
        } else {
            // dd('validation');
            return $this->sendError($validator->errors()->all(), 'Operation echouée');
        }

        // return redirect('/abonnement')->with('success', 'Abonnement Modifié avec succès');

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
        if(!$abonnement->fails){
            $abonnement->delete();
            return $this->sendResponse($abonnement, 'Opération effectuée avec succès.');
        } else {
            return $this->sendError('Id introuvable', 'Operation echouée');
        }
        // return redirect('/abonnement')->with('success', 'Abonnement supprimé avec succès');
    }
}
