<?php

namespace App\Http\Controllers\API\Parametres;

use Illuminate\Http\Request;
use App\Models\Mode_Paiement;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController;

class ModePaiementController extends BaseController
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
        $query = Mode_Paiement::query();
        if($request->has('data')){
            if ($request->has('data.code')) {
                $query->where('code', 'LIKE', '%' . $req['data']['code'] . '%');
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
        $req = $request->all();
        $validator = Validator::make($req, [
            'data' => 'required|array',
            'data.code' => 'required|string',
            'data.libelle' => 'required|string',
        ]);
        // dd($validator->passes());
        if($validator->passes()){
            $data = new Mode_Paiement([
                'code' => $req['data']['code'],
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
            'data.code' => 'required|string',
            'data.libelle' => 'required|string'
        ]);
        
        if($validator->passes()){
            $data = Mode_Paiement::findOrFail($req['data']['id']);
            $data->id = $req['data']['id'];
            $data->code = $req['data']['code'];
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
        $data = Mode_Paiement::findOrFail($req['data']['id']);
        if(!$data->fails()){
            $data->delete();
            return $this->sendResponse($data, 'Opération effectuée avec succès.');
        } else {
            return $this->sendError('Id introuvable', 'Operation echouée');
        }
    }
}
