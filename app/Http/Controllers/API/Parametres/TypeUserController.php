<?php

namespace App\Http\Controllers\API\Parametres;

use App\Models\Type_User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController;

class TypeUserController extends BaseController
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
         // return Type_User::where('libelle','like','%'.$req['data']['libelle'].'%')
        // ->orderBy('name')
        // ->take(10)
        // ->get();
        $data = Type_User::paginate($req['size']);
        if(!$data->isEmpty()){
            return $this->sendResponse($data, 'Opération effectuée avec succès.');
        } else {
            return $this->sendResponse([], 'Aucune donnée trouver');
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
        // dd($request->all());
        $req = $request->all();
        // dd($req);
        $validator = Validator::make($req, [
            'data' => 'required|array',
            'data.code' => 'required|string',
            'data.libelle' => 'required|string',
        ]);
        // dd($validator->passes());
        if($validator->passes()){
            $type_user = new Type_User([
                'code' => $req['data']['code'],
                'libelle' => $req['data']['libelle'],
            ]);
            $type_user->save();
            return $this->sendResponse($type_user, 'Opération effectuée avec succès.');
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
        // dd($req);
        if($validator->passes()){
            $type_user = Type_User::findOrFail($req['data']['id']);
            $type_user->id = $req['data']['id'];
            $type_user->code = $req['data']['code'];
            $type_user->libelle = $req['data']['libelle'];
            $type_user->update();
            $type_user->save();
            return $this->sendResponse($type_user, 'Opération effectuée avec succès.');
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
        $data = Type_User::findOrFail($req['data']['id']);
        if(!$data->fails()){
            $data->delete();
            return $this->sendResponse($data, 'Opération effectuée avec succès.');
        } else {
            return $this->sendError('Id introuvable', 'Operation echouée');
        }
    }
}
