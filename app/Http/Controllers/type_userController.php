<?php

namespace App\Http\Controllers;

use App\Models\Type_User;
use Illuminate\Http\Request;

class type_userController extends Controller
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
    public function update(Request $request, $id)
    {
        $request->validate([
          
            'code'=> 'required',
            'nom' => 'required',
            'prenoms' => 'required'

        ]);

        $type_user = Type_User::findOrFail($id);
        $type_user->code = $request->get('code');
        $type_user->nom = $request->get('nom');
        $type_user->prenoms = $request->get('prenoms');
      
        $type_user->update();

        return redirect('/type_user')->with('success', 'Modifié avec succès');
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
