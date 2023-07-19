<?php

namespace App\Http\Controllers\API;

use App\Models\Capteur;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController;

class CapteurController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        // dd($request);
        $req = $request->all();
        $query = Capteur::join('place_stationnements', 'place_id', '=', 'place_stationnements.id')
                          ->join('statuts', 'capteurs.statut_id', '=', 'statuts.id')
                          ->join('gateway', 'gateway_id', '=', 'gateway.id')
                          ->select('capteurs.id as id', 'capteurs.libelle as libelle', 'etat', 
                                    'place_stationnements.id as place_id', 'capteurs.statut_id as statut_id', 
                                    'statuts.libelle as statut_libelle', 'gateway_id', 'gateway.libelle as gateway_libelle', 
                                    'place_stationnements.libelle as place_libelle');
        // dd($request->has('data'));
        if($request->has('data')){
            if ($request->has('data.libelle')) {
                $query->where('capteurs.libelle', 'LIKE', '%' . $req['data']['libelle'] . '%');
            }
            
            if ($request->has('data.etat')) {
                $query->where('etat', 'LIKE', '%' . $req['data']['etat'] . '%');
            }

            if ($request->has('data.place_id')) {
                $query->where('capteurs.place_id', $req['data']['place_id']);
            }

            if ($request->has('data.statut_id')) {
                $query->where('capteurs.statut_id',  $req['data']['statut_id']);
            }

            if ($request->has('data.gateway_id')) {
                $query->where('capteurs.gateway_id', $req['data']['gateway_id']);
            }

            if(isset($req['size'])){
                $results = $query->paginate($req['size']);
            } else {
                $results = $query->get();
            }

            if(!$results->isEmpty()){
                return $this->sendResponse($results, 'Opération effectuée avec succès.');
            } else {
                return $this->sendResponse([], 'Aucune donnée trouver');
            }
        } else{
            return $this->sendError('Format incorrect: data inexistant', 'Opération échouée');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $messages = [
            'data.libelle.required' => 'Ce champs est requis.',
            'data.etat.required' => 'Ce champs est requise.',
            'data.place_id.required' => 'La place indiqué n\'est pas valide.',
            'data.place_id.integer' => 'La place doit être un entier.',
            'data.place_id.exists' => 'La place sélectionné n\'est pas valide.',
            'data.statut_id.required' => 'Le statut indiqué n\'est pas valide.',
            'data.statut_id.integer' => 'Le statut doit être un entier.',
            'data.statut_id.exists' => 'Le statut sélectionné n\'est pas valide.',
            'data.gateway_id.required' => 'Le gateway indiqué n\'est pas valide.',
            'data.gateway_id.integer' => 'Le gateway doit être un entier.',
            'data.gateway_id.exists' => 'Le gateway sélectionné n\'est pas valide.',
        ];
        
        $req = $request->all();
        $validator = Validator::make($req, [
            'data' => 'required|array',
            'data.etat' => 'required|string',
            'data.libelle' => 'required|string',
            'data.place_id' => 'required|integer|exists:App\Models\Place_Stationnement,id',
            'data.statut_id' => 'required|integer|exists:App\Models\Statut,id',
            'data.gateway_id' => 'required|integer|exists:App\Models\Gateway,id',
        ], $messages);
        // dd($validator->passes());
        if($validator->passes()){
            // dd($req);
            $data = new Capteur([
                'etat' => $req['data']['etat'],
                'libelle' => $req['data']['libelle'],
                'place_id' => $req['data']['place_id'],
                'statut_id' => $req['data']['statut_id'],
                'gateway_id' => $req['data']['gateway_id'],
            ]);
            
            // dd($data);
            $data->save();
            return $this->sendResponse($data, 'Opération effectuée avec succès.');
        } else {
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
        //
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
        //
        $req = $request->all();
        // echo "Before Validator::make<br>";
        $validator = Validator::make($req, [
            'data' => 'required|array',
            'data.id' => 'required',
            'data.libelle' => 'string',
            'data.etat' => 'string',
            'data.place_id' => 'integer|exists:App\Models\Place_Stationnement,id',
            'data.statut_id' => 'integer|exists:App\Models\Statut,id',
            'data.gateway_id' => 'integer|exists:App\Models\Gateway,id',
        ]);
        // dd($req);
        /* Check if parking exist */
        // $parking = Parking::findOrFail($req['data']['parking_id']);
        // if($parking->fails()){
        //     return $this->sendError('Parking_id fournit est introuvable', 'Operation echouée');
        // }
        if($validator->passes()){
            $data = Capteur::findOrFail($req['data']['id']);
            $data->id = $req['data']['id'];
            if ($request->has('data.libelle')) {
                $data->libelle = $req['data']['libelle'];
            }
            if ($request->has('data.etat')) {
                $data->etat = $req['data']['etat'];
            }
            if ($request->has('data.place_id')) {
                $data->place_id = $req['data']['place_id'];
            }
            if ($request->has('data.statut_id')) {
                $data->statut_id = $req['data']['statut_id'];
            }
            if ($request->has('data.gateway_id')) {
                $data->gateway_id = $req['data']['gateway_id'];
            }
            $data->update();
            $data->save();
            return $this->sendResponse($data, 'Opération effectuée avec succès.');
        } else {
            // dd('validation');
            return $this->sendError($validator->errors()->all(), 'Operation echouée');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $req = $request->all();
        $data = Capteur::findOrFail($req['data']['id']);
        if(!$data->fails()){
            $data->delete();
            return $this->sendResponse($data, 'Opération effectuée avec succès.');
        } else {
            return $this->sendError($data->errors()->all(), 'Operation echouée');
        }
    }
}
