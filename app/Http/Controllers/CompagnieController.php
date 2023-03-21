<?php

namespace App\Http\Controllers;

use App\Models\Compagnie;
use Illuminate\Http\Request;

class CompagnieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $compagnie = Compagnie::all();
        return view('pages.compagnie.index', compact('compagnie'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.compagnie.create');

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
            'contact' => 'required',
            'email' => 'required'
        ]);


        $compagnie = new Compagnie([
            'id' => $request->get(''),
            'libelle' => $request->get('libelle'),
            'contact' => $request->get('contact'),
            'email' => $request->get('email')
        ]);


        $compagnie->save();
        return redirect('/compagnie')->with('success', 'compagnie Ajouté avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $compagnie= Compagnie::findOrFail($id);
        return view('pages.compagnie.show', compact('compagnie'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $compagnie = Compagnie::findOrFail($id);
        return view('pages.compagnie.edit', compact('compagnie'));
       
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

            
            'libelle'=> 'required',
            'contact'=> 'required',
            'email' => 'required',
        ]);

        

        $compagnie = Compagnie::findOrFail($id);
        $compagnie->libelle = $request->get('libelle');
        $compagnie->contact = $request->get('contact');
        $compagnie->email = $request->get('email');

        $compagnie->update();

        return redirect('/compagnie')->with('success', 'compagnie Modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        $compagnie = Compagnie::findOrFail($id);
        $compagnie->delete();

        return redirect('/compagnie')->with('success', 'Compagnie Modifié avec succès');
    }
}
