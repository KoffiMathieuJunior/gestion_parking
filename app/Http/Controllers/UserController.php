<?php

namespace App\Http\Controllers;

use App\Models\Type_Vehicule;
use App\Models\User;
use App\Models\Vehicule;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $user = new User();
        return view('pages.user.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.user.create');

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
            'nom'=> 'required',
            'prenoms' => 'required',
            'contact' => 'required',
            'email' => 'required',
            'compagnie_id' => 'required',

        ]);


        $user = new User([

            'id' => $request->get(''),
            'nom' => $request->get('nom'),
            'prenoms' => $request->get('prenoms'),
            'contact' => $request->get('contact'),
            'email' => $request->get('email'),
            'compagnie_id' => $request->get('compagnie_id')
        ]);


        $user->save();
        return redirect('/user')->with('success', 'utilisateur Ajouté avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('pages.ser.show', compact('User'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('pages.ser.edit', compact('user'));
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
            'nom'=> 'required',
            'prenoms' => 'required',
            'contact' => 'required',
            'email' => 'required',
            'compagnie_id' => 'required',


        ]);




        $user = User::findOrFail($id);
        
        $user->id = $request->get('');
        $user->nom = $request->get('nom');
        $user->prenoms = $request->get('prenoms');
        $user->contact = $request->get('contact');
        $user->email= $request->get('email');
        $user->compagnie_id = $request->get('compagnie_id');

        $user->update();

        return redirect('/user')->with('success', 'utilisateur Modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { 
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('/user')->with('success', 'Utilisateur Modifié avec succès');

    }
}
