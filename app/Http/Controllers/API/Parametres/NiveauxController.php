<?php

namespace App\Http\Controllers\API\Parametres;

use App\Models\Niveau;
use App\Models\Parking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController;

class NiveauxController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $req = $request->all();
        $query = Niveau::join('parkings', 'parking_id', '=', 'parkings.id')
                        ->join('ville', 'parkings.ville_id', '=', 'ville.id')
                         ->select('niveaux.id as id', 'code', 'numero', 'capacite', 'parkings.libelle as parking_libelle', 'adresse',
                                 'parking_id', 'ville.libelle as ville_libelle');
        if($request->has('data')){
            if ($request->has('data.code')) {
                $query->where('code', 'LIKE', '%' . $req['data']['code'] . '%');
            }
            
            if ($request->has('data.numero')) {
                $query->where('numero', 'LIKE', '%' . $req['data']['numero'] . '%');
            }

            if ($request->has('data.capacite')) {
                $query->where('capacite', 'LIKE', '%' . $req['data']['capacite'] . '%');
            }
            // dd($req['data']['parking_id']);
            if ($request->has('data.parking_id')) {
                $query->where('parking_id', $req['data']['parking_id']);
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
         /* 
        return Destination::addSelect(['last_flight' => Flight::select('name')
                    ->whereColumn('destination_id', 'destinations.id')
                    ->orderByDesc('arrived_at')
                    ->limit(1)
                ])->get();
        */
        $req = $request->all();
        $validator = Validator::make($req, [
            'data' => 'required|array',
            'data.code' => 'required|string',
            'data.numero' => 'required|integer',
            'data.capacite' => 'required|integer',
            'data.parking_id' => 'required|integer|exists:App\Models\Parking,id',
        ]);
        // dd($validator->fails());
        // $parking = Parking::findOrFail($req['data']['parking_id']);
        // if($parking->fails()){
        //     return $this->sendError('Parking_id fournit est introuvable', 'Operation echouée');
        // }
        if($validator->passes()){
            $data = new Niveau([
                'code' => $req['data']['code'],
                'numero' => $req['data']['numero'],
                'capacite' => $req['data']['capacite'],
                'parking_id' => $req['data']['parking_id'],
            ]);
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
            'data.code' => 'required|string',
            'data.numero' => 'required|integer',
            'data.capacite' => 'required|integer',
            'data.parking_id' => 'required|integer|exists:App\Models\Parking,id',
        ]);
        // dd($req);
        /* Check if parking exist */
        // $parking = Parking::findOrFail($req['data']['parking_id']);
        // if($parking->fails()){
        //     return $this->sendError('Parking_id fournit est introuvable', 'Operation echouée');
        // }
        if($validator->passes()){
            $data = Niveau::findOrFail($req['data']['id']);
            $data->id = $req['data']['id'];
            $data->code = $req['data']['code'];
            $data->numero = $req['data']['numero'];
            $data->capacite = $req['data']['capacite'];
            $data->parking_id = $req['data']['parking_id'];
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
        $data = Niveau::findOrFail($req['data']['id']);
        if(!$data->fails()){
            $data->delete();
            return $this->sendResponse($data, 'Opération effectuée avec succès.');
        } else {
            return $this->sendError($data->errors()->all(), 'Operation echouée');
        }
    }
}
