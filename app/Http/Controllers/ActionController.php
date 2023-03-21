<?php

namespace App\Http\Controllers;

use App\Models\Action;
use Illuminate\Http\Request;

class ActionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('pages.action.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        
        return view('pages.action.create');
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
            'libelle' => 'required',
            'parent_id' => 'required',
            
        ]);


        $action = new Action([
            
            'code' => $request->get('code'),
            'libelle' => $request->get('libelle'),
            'parent_id' => $request->get('parent_id'),
            
        ]);

        $action->save();
        return redirect('/action')->with('success', 'Action Ajouté avec succès');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        
        return view('pages.action.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       

        return view('pages.action.edit');
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
            'libelle' => 'required',
            'parent_id' => 'required'
           
        ]);




        $action = Action::findOrFail($id);
       
        $action->code = $request->get('code');
        $action->libelle = $request->get('libelle');
        $action->parent_id = $request->get('parent_id');
      

        $action->update();

        return redirect('/action')->with('success', 'Action Modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $action = Action::findOrFail($id);
        $action->delete();

        return redirect('/action')->with('success', 'Action Modifié avec succès');
    }
}
