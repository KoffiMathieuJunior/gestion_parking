<?php

namespace App\Http\Controllers\API\Parametres;

use App\Http\Controllers\API\BaseController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ville;
use Illuminate\Support\Facades\Validator;

class VillesController extends BaseController
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
        // dd($req);
        $query = Ville::join('pays', 'ville.pays_id', '=', 'pays.id')
            ->select('ville.id as id', 'ville.libelle as libelle', 'pays.libelle as pays_libelle', 'language', 'indicatif');
        
        if($request->has('data')){
            if ($request->has('data.pays_id')) {
                $query->where('pays_id', $req['data']['pays_id']);
            }

            if ($request->has('data.libelle')) {
                $query->where('libelle', 'LIKE', '%' . $req['data']['libelle'] . '%');
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
            'data.pays_id' => 'required|integer|exists:App\Models\Pays,id',
            // 'data.libelle' => 'required|unique:ville|string',
            'data.libelle' => 'required|string',
        ]);
        // dd($validator->passes());
        if($validator->passes()){
            $data = new Ville([
                'pays_id' => $req['data']['pays_id'],
                'libelle' => $req['data']['libelle'],
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
            'data.pays_id' => 'required|integer|exists:App\Models\Pays,id',
            'data.libelle' => 'required|string'
        ]);
        // dd($req);
        if($validator->passes()){
            $data = Ville::findOrFail($req['data']['id']);
            $data->id = $req['data']['id'];
            $data->pays_id = $req['data']['pays_id'];
            $data->libelle = $req['data']['libelle'];
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
        $data = Ville::findOrFail($req['data']['id']);
        if(!$data->fails()){
            $data->delete();
            return $this->sendResponse($data, 'Opération effectuée avec succès.');
        } else {
            return $this->sendError($data->errors()->all(), 'Operation echouée');
        }
    }
}
