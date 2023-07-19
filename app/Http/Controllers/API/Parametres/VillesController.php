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
        $messages = [
            'data.libelle.required' => 'Le libelle est requis.',
            'data.pays_id.required' => 'Le pays indiqué n\'est pas valide.',
            'data.pays_id.integer' => 'Le pays indiqué doit être un entier.',
            'data.pays_id.exists' => 'Le pays indiqué sélectionnée n\'est pas valide.',
        ];
        $req = $request->all();
        $validator = Validator::make($req, [
            'data' => 'required|array',
            'data.pays_id' => 'required|integer|exists:App\Models\Pays,id',
            // 'data.libelle' => 'required|unique:ville|string',
            'data.libelle' => 'required|string',
        ], $messages);
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
        $messages = [
            'data.id.required' => 'Id non renseigné.',
            'data.libelle.required' => 'Le libelle est requis.',
            'data.pays_id.required' => 'Le pays indiqué n\'est pas valide.',
            'data.pays_id.integer' => 'Le pays indiqué doit être un entier.',
            'data.pays_id.exists' => 'Le pays indiqué sélectionnée n\'est pas valide.',
        ];
        $req = $request->all();
        // echo "Before Validator::make<br>";
        $validator = Validator::make($req, [
            'data' => 'required|array',
            'data.id' => 'required',
            'data.pays_id' => 'required|integer|exists:App\Models\Pays,id',
            'data.libelle' => 'required|string'
        ], $messages);
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
