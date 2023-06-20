<?php

namespace App\Http\Controllers\API\Parametres;

use App\Models\Pays;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController;

class PaysController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $query = Pays::query();
        $req = $request->all();
        // return Statut::where('libelle','like','%'.$req['data']['libelle'].'%')
      // ->orderBy('name')
      // ->take(10)
      // ->get();
      if($request->has('data')){
            if ($request->has('data.code')) {
                $query->where('code', 'LIKE', '%' . $req['data']['code'] . '%');
            }
            
            if ($request->has('data.libelle')) {
                $query->where('libelle', 'LIKE', '%' . $req['data']['libelle'] . '%');
            }

            if ($request->has('data.flags')) {
                $query->where('flags', 'LIKE', '%' . $req['data']['flags'] . '%');
            }

            if ($request->has('data.indicatif')) {
                $query->where('indicatif', 'LIKE', '%' . $req['data']['indicatif'] . '%');
            }
            
            if ($request->has('data.language_code')) {
                $query->where('language_code', 'LIKE', '%' . $req['data']['language_code'] . '%');
            }
            
            if ($request->has('data.language')) {
                $query->where('language', 'LIKE', '%' . $req['data']['language'] . '%');
            }
            if($request->has('size')){
                $results = $query->paginate($request['size']);
            } else {
                $results = $query->get();
            }
            if(!$results->isEmpty()){
                return $this->sendResponse($results, 'Opération effectuée avec succès.');
            } else {
                return $this->sendResponse([], 'Aucune donnée trouvée');
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
            'data.libelle.unique' => 'Ce pays exsite déjà',
            'data.code.required' => 'Le code est requis.',
            'data.flags.required' => 'Le flag est requis.',
            'data.indicatif.required' => `L'indicatif est requis.`,
            'data.language.required' => `La langue est requise.`,
            'data.language_code.required' => `Le code language est requis.`,
        ];
        // dd($request);
        $req = $request->all();
        $validator = Validator::make($req, [
            'data' => 'required|array',
            'data.code' => 'required|unique:gateway,username',
            'data.libelle' => 'required|unique:gateway,username',
            'data.flags' => 'required|string',
            'data.indicatif' => 'required|string',
            'data.language' => 'required|string',
            'data.language_code' => 'required|string',
        ], $messages);
        // dd($validator->passes());
        if($validator->passes()){
            $data = new Pays([
                'code' => $req['data']['code'],
                'libelle' => $req['data']['libelle'],
                'flags' => $req['data']['flags'],
                'indicatif' => $req['data']['indicatif'],
                'language' => $req['data']['language'],
                'language_code' => $req['data']['language_code'],
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
            'data.id' => 'required',
            'data.code' => 'required|string',
            'data.libelle' => 'required|string',
            'data.flags' => 'required|string',
            'data.indicatif' => 'required|string',
            'data.language' => 'required|string',
            'data.language_code' => 'required|string',
        ]);
        // dd($validator->passes());
        if($validator->passes()){
            $data = Pays::findOrFail($req['data']['id']);
            // $data->id = $req['data']['id'];
            $data->code = $req['data']['code'];
            $data->libelle = $req['data']['libelle'];
            $data->flags = $req['data']['flags'];
            $data->indicatif = $req['data']['indicatif'];
            $data->language = $req['data']['language'];
            $data->language_code = $req['data']['language_code'];
            $data->update();
            $data->save();
            return $this->sendResponse($data, 'Opération effectuée avec succès.');
        } else {
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
        // dd($req);
        $data = Pays::findOrFail($req['data']['id']);
        if(!$data->fails()){
            $data->delete();
            return $this->sendResponse($data, 'Opération effectuée avec succès.');
        } else {
            return $this->sendError($data->errors()->all(), 'Operation echouée');
        }
    }
}
