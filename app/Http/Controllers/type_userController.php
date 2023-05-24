<?php

namespace App\Http\Controllers;

use App\Models\Type_User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController;

class type_userController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $type_user = Type_User::all();
        return view('pages.type_user.index', compact('type_user'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request)
    {
        
        $type_user = Type_User::paginate(10);
        if(!$type_user->isEmpty()){
            return $this->sendResponse($type_user, 'Opération effectuée avec succès.');
        } else {
            return $this->sendResponse([], 'Aucune donnée trouver');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.type_user.create');
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
            'nom' => 'required', 
            'prenoms' => 'required', 
           
        ]);


        $type_user = new Type_User([
            
            'code' => $request->get('code'),
            'nom' => $request->get('nom'),
            'prenoms' => $request->get('prenoms'),
            
        ]);


        $type_user->save();
        return redirect('/type_user')->with('success', 'Ajouté avec succès');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createTypeUser(Request $request)
    {
        $req = $request->all();
        $validator = Validator::make($req, [
            'data' => 'required|array',
            'data.code' => 'required|string',
            'data.libelle' => 'required|string',
        ]);
        
        if($validator->passes()){
            $type_user = new Type_User([
                'code' => $request->get('code'),
                'libelle' => $request->get('libelle'),
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
        $type_user = Type_User::findOrFail($id);
        return view('pages.type_user.show', ['type_user' => $type_user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $type_user= Type_User::findOrFail($id);
        return view('pages.type_user.edit', compact('type_user'));
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
        $validator = Validator::make($req, [
            'data' => 'required|array',
            'data.id' => 'required',
            'data.code' => 'required|string',
            'data.libelle' => 'required|string',
        ]);

        if($validator->passes()){
            $type_user = Type_User::findOrFail($req['data']['id']);
            $type_user->code = $request->get('code');
            $type_user->nom = $request->get('nom');
            $type_user->prenoms = $request->get('prenoms');
        
            $type_user->update();

            return $this->sendResponse($type_user, 'Opération effectuée avec succès.');
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
    public function destroy($id)
    {
        $type_user = Type_User::findOrFail($id);
        $type_user->delete();

        return redirect('/type_user')->with('success', ' supprimé avec succès');
    }
}
