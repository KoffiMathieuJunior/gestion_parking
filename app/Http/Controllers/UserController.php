<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vehicule;
use Illuminate\Http\Request;
use App\Models\Type_Vehicule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\API\BaseController;

class UserController extends BaseController
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

    // API get users 
    public function getUsers(Request $request){
        // $users = User::query();
        // dd($request->user());
        // if (auth()->check()) {
            // l'utilisateur est authentifié, on peut renvoyer la liste des utilisateurs
            // $query = $request->input('query');
            $query = User::join('statuts', 'users.statut_id', '=', 'statuts.id')
                ->join('type_users', 'users.type_user_id', '=', 'type_users.id')
                ->select('users.id as id', 'nom', 'prenoms', 'login', 'contact', 'email',
                  'statut_id', 'type_user_id', 'statuts.libelle as statut_libelle', 'type_users.id as type_user_libelle');
            $req = $request->all();
            if($request->has('data')){
                if ($request->has('data.nom')) {
                    $query->where('nom', 'LIKE', '%' . $req['data']['nom'] . '%');
                }

                if ($request->has('data.prenoms')) {
                    $query->where('prenoms', 'LIKE', '%' . $req['data']['prenoms'] . '%');
                }

                if ($request->has('data.login')) {
                    $query->where('login', 'LIKE', '%' . $req['data']['login'] . '%');
                }

                if ($request->has('data.contact')) {
                    $query->where('contact', 'LIKE', '%' . $req['data']['contact'] . '%');
                }

                if ($request->has('data.email')) {
                    $query->where('email', 'LIKE', '%' . $req['data']['email'] . '%');
                }

                if ($request->has('data.id')) {
                    $query->where('id', '=', $req['data']['id']);
                }

                if ($request->has('data.type_user_id')) {
                    $query->where('type_user_id', '=', $req['data']['type_user_id']);
                }

                if ($request->has('data.statut_id')) {
                    $query->where('statut_id', '=', $req['data']['statut_id']);
                }

                if ($request->has('data.sexe')) {
                    $query->where('sexe', '=', $req['data']['sexe']);
                }

                foreach ($query as $user) {
                    $user->image_url = Storage::url($user->image_path);
                }
                $results = $query->paginate(10);
                foreach ($query as $user) {
                    $user->image = '/path/to/image/' . $user->image; // Remplacer le chemin par le chemin réel de l'image
                }
                if(!$results->isEmpty()){
                    // $path = storage_path('app/public/images/' . $results->logo);

                    // if (!file_exists($path)) {
                    //     abort(404);
                    // }

                    // $file = file_get_contents($path);

                    // $type = mime_content_type($path);
                    // $results->logo = $file;
                    return $this->sendResponse($results, 'Opération effectuée avec succès.');
                } else {
                    return $this->sendResponse([], 'Aucune donnée trouver');
                }
            }   else {
                return $this->sendError('Format incorrect: data inexistant', 'Opération échouée');
            }
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

    // API create User
    public function createUser(Request $req){
        $user = new User;
        $user->nom = $req->input('nom');
        $user->prenom = $req->input('prenom');
        $user->login = $req->input('login');
        $user->contact = $req->input('contact');
        $user->compagne_id = $req->input('compagne_id');
        $user->proprietaire_id = $req->input('proprietaire_id');
        $user->type_user_id = $req->input('type_user_id');
        $user->image = $req->input('image');
        $user->email = $req->input('email');
        $user->password = Hash::make($req->input('password'));
        if ($req->hasFile('image')) {
            $file = $req->file('image');
            $filename = $file->getClientOriginalName();
            $file->storeAs('uploads', $filename, 'public');
            return response()->json(['message' => 'Image sauvegardée avec succès']);
        } else {
            return response()->json(['message' => 'Aucune image sauvegardée'], 400);
        }
        $user->save();
        // return response()->json($user);
        return response()->json([
            "success" => true,
            "message" => "Opération éffectuée avec succès",
            "datas" => $user
        ]);
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

    // API delete users
    public function deleteUser($id)
    {
        User::destroy($id);
        return response()->json(['message' => 'Utilisateur supprimer avec succès']);
    }
}
