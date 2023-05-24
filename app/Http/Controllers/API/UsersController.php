<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

     /**
     * 
     * 
     */
    public function getImage(Request $request)
    {
        $data = User::findOrFail($request['data']['id']);
        $path = storage_path('app/public/images/' . $data->logo);

        if (!file_exists($path)) {
            abort(404);
        }

        $file = file_get_contents($path);

        $type = mime_content_type($path);

        return response($file)->header('Content-Type', $type);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //'in:Femme,Homme'
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
            'data.nom' => 'required|string',
            'data.prenoms' => 'required|string',
            'data.login' => 'required|unique:users',
            // 'data.password' => 'required|unique:users',
            'data.password' => [
                'required', 
                // 'confirmed', 
                Password::min(8),
                Password::min(8)->letters(),
                Password::min(8)->mixedCase(),
                Password::min(8)->numbers(),
                Password::min(8)->symbols()
            ],
            'data.contact'=> 'required|string|min:10|max:14',
            'data.type_user_id' => 'required|integer|exists:App\Models\type_user,id',
            'data.statut_id' => 'required|integer|exists:App\Models\Statut,id',
            'data.image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'data.sexe' => 'required|in:Femme,Homme',
        ]);
        // dd($req);
        
        if($validator->passes()){
            $data = User::findOrFail($req['data']['id']);
            $data->id = $req['data']['id'];
            $data->nom = $req['data']['nom'];
            $data->prenoms = $req['data']['prenoms'];
            $data->login = $req['data']['login'];
            $data->password =  Hash::make($req['data']['password']);
            $data->contact =  $req['data']['contact'];
            $data->type_user_id =  $req['data']['type_user_id'];
            $data->statut_id =  $req['data']['statut_id'];
            // $data->image =  $req['data']['image'];
            $data->image =  $request->file('image')->storeAs('user_photo', date("d/m/Y H:i:s").'-'.$req['data']['image']->image->getClientOriginalName());
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
        $data = User::findOrFail($req['data']['id']);
        if(!$data->fails()){
            $data->delete();
            return $this->sendResponse($data, 'Opération effectuée avec succès.');
        } else {
            return $this->sendError($data->errors()->all(), 'Operation echouée');
        }
    }
}
