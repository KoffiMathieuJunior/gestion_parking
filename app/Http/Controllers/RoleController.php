<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        
        return view('pages.role.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data=[];
        $data["role"]= Role::all();
        $role= Role::all();
        $data["user"]= User::all();
        return view('pages.role.create',compact('data'));

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
            'id'=>'',
            'libelle'=> 'required',
            'code' => 'required',
            'user_id' => 'required',
        ]);


        $role = new Role([
            'id' => $request->get(''),
            'libelle' => $request->get('libelle'),
            'code' => $request->get('code'),
            'user_id' => $request->get('user_id')
        ]);


        $role->save();
        return redirect('/role')->with('success', 'Role Ajouté avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        return view('pages.role.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


        return view('pages.role.edit');
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

            'id'=>'',
            'libelle'=> 'required',
            'code' => 'required',
            'user_id' => 'required',

        ]);




        $role = Role::findOrFail($id);
        $role->id = $request->get('');
        $role->libelle = $request->get('libelle');
        $role->code = $request->get('code');
        $role->user_id = $request->get('user_id');


        $role->update();

        return redirect('/role')->with('success', 'role Modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect('/role')->with('success', 'Role Modifié avec succès');
    }
}
