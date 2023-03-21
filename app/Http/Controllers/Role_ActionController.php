<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Action;
use App\Models\Role_Action;
use Illuminate\Http\Request;

class Role_ActionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        
        return view('pages.role_action.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $data=[];
        $data["role_action"]= Role_Action::all();
        $role_action= Role_Action::all();
        $data["role"]= Role::all();
        $data["action"]= Action::all();
        return view('pages.role_action.create',compact('data'));
      

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
            'role_id'=> 'required',
            'action_id' => 'required',
           
        ]);


        $role_action = new Role_Action([
            'id' => $request->get(''),
            'role_id' => $request->get('role_id'),
            'action_id' => $request->get('action_id'),
            
        ]);


        $role_action->save();
        return redirect('/role_action')->with('success', 'role action Ajouté avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        return view('pages.role_action.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        

        return view('pages.role_action.edit');
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
            'role_id'=> 'required',
            'action_id' => 'required',

        ]);




        $role_action = Role_Action::findOrFail($id);
        $role_action->id= $request->get('');
        $role_action->role_id = $request->get('role_id');
        $role_action->action_id = $request->get('Role_Action');

        $role_action->update();

        return redirect('/role_action')->with('success', 'role action Modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $role_action = Role_Action::findOrFail($id);
        $role_action->delete();

        return redirect('/role_action')->with('success', 'role action Modifié avec succès');
    }
}
