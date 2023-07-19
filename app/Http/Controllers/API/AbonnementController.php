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
    public function index(Request $request)
    {
       
        // $abonnement = Abonnement::paginate(10);
        $req = $request->all();
        $query = Abonnement::join('users', 'client_id', '=', 'users.id')
                            ->join('place_stationnements', 'place_stationnements_id', '=', 'place_stationnements.id')
                            ->join('statuts', 'place_stationnements.statut_id', '=', 'statuts.id')
                            ->select('abonnements.id as id', 'abonnements.libelle as libelle', 'abonnements.code as code', 
                            'date_debut', 'date_fin', 'place_stationnements.libelle as place_libelle', 'statuts.libelle as place_statut_libelle');
        if($request->has('data')){
            if ($request->has('data.client_id')) {
                $query->where('client_id', $req['data']['client_id']);
            }
            
            if ($request->has('data.place_stationnements_id')) {
                $query->where('place_stationnements_id', $req['data']['place_stationnements_id']);
            }
            
            if ($request->has('data.type_abonnement_id')) {
                $query->where('type_abonnement_id', $req['data']['type_abonnement_id']);
            }

            if ($request->has('data.libelle')) {
                $query->where('libelle', 'LIKE', '%' . $req['data']['libelle'] . '%');
            }

            if ($request->has('data.date_debut')) {
                $query->where('date_debut', 'LIKE', '%' . $req['data']['date_debut'] . '%');
            }

            if ($request->has('data.date_fin')) {
                $query->where('date_fin', 'LIKE', '%' . $req['data']['date_fin'] . '%');
            }

            if ($request->has('data.code')) {
                $query->where('code', 'LIKE', '%' . $req['data']['code'] . '%');
            }

            if(isset($req['size'])){
                $results = $query->paginate($req['size']);
            } else {
                $results = $query->get();
            }
            // $data = Statut::paginate($req['size'] ? $req['size'] : 0);
            if(!$results->isEmpty()){
                return $this->sendResponse($results, 'Opération effectuée avec succès.');
            } else {
                return $this->sendResponse([], 'Aucune donnée trouver');
            }
        } else {
            return $this->sendError('Format incorrect: data inexistant', 'Opération échouée');
        }
        // $req = $request->all();
        // $data = Abonnement::paginate($req['size']);
        // if(!$data->isEmpty()){
        //     return $this->sendResponse($data, 'Opération effectuée avec succès.');
        // } else {
        //     return $this->sendResponse([], 'Aucune donnée trouver');
        // }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $req = $request->all();
        // echo "Before Validator::make<br>";
        $validator = Validator::make($req, [
            'data' => 'required|array',
            'data.code' => 'required|string',
            'data.libelle' => 'required|string',
            'data.client_id' => 'required|integer|exists:App\Models\User,id',
            'data.place_stationnements_id' => 'required|integer|exists:App\Models\Place_Stationnement,id',
            'data.type_abonnement_id' => 'required|integer|exists:App\Models\type_abonnement,id',
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
                'place_stationnements_id' =>  $req['data']['place_stationnements_id'],
                'type_abonnement_id' =>  $req['data']['type_abonnement_id'],
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
        // $abonnement = Abonnement::findOrFail($id);
        // return view('pages.abonnement.show', ['abonnement' => $abonnement]);
       
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
            'data.type_abonnement_id' => 'required|string',
            'data.date_debut' => 'required|date_format:d/m/Y',
            'data.date_fin' => 'required|date_format:d/m/Y',
            'data.statut' => 'required|string',
        ]);

        if($validator->passes()){
        
            $abonnement = Abonnement::findOrFail($req['data']['id']);
            $abonnement->id = $req['data']['id'];
            $abonnement->code = $req['data']['code'];
            $abonnement->libelle = $req['data']['libelle'];
            $abonnement->client_id = $req['data']['client_id'];
            $abonnement->place_stationnements_id = $req['data']['place_stationnements_id'];
            $abonnement->type_abonnement_id = $req['data']['type_abonnement_id'];
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
        if(!$abonnement->fails()){
            $abonnement->delete();
            return $this->sendResponse($abonnement, 'Opération effectuée avec succès.');
        } else {
            return $this->sendError('Id introuvable', 'Operation echouée');
        }
        // return redirect('/abonnement')->with('success', 'Abonnement supprimé avec succès');
    }
}
