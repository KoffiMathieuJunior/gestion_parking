<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\compagnie;
// use App\Http\Controllers\Controller;
use App\Mail\BienvenueMail;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use App\Http\Controllers\API\BaseController;
use App\Models\type_user;

class PassportAuthController extends BaseController
{
    //
    /**
     * Registration Req
     */
    public function register(Request $request)
    {
        // dd($request);
        $messages = [
            'data.nom.required' => 'Le nom est requis.',
            'data.prenoms.required' => 'Le prenoms est requis.',
            'data.login.required' => 'Le login est requis',
            'data.login.unique' => 'Ce login existe deja',
            'data.contact.unique' => 'Le contact existe deja',
            'data.password.required' => 'Ce champs est requis',
            'data.password.min' => 'Ce champs doit comporter au moins 8 caractères',
            'data.password.letters' => 'Ce champs doit comporter au moins une lettre',
            'data.password.mixedCase' => 'Ce champs doit comporter au une lettre majuscule',
            'data.password.symbols' => 'Ce champs doit comporter des caractères spéciaux',
            'data.sexe.required' => 'Le sexe est requis.',
            'data.image.required' => 'L\'image est requise.',
            'data.type_user_id.required' => 'Le type user est requis.',
            'data.type_user_id.integer' => 'Le type user doit être un entier.',
            'data.type_user_id.exists' => 'Le type user sélectionné n\'est pas valide.',
            'data.statut_id.required' => 'Le statut est requis.',
            'data.statut_id.integer' => 'Le statut doit être un entier.',
            'data.statut_id.exists' => 'Le statut sélectionné n\'est pas valide.',
        ];
        // $validators = $this->validate($request, [
            // $req = $request->all();
            $validators = Validator::make($request->all(), [
                'nom' => 'required',
                'prenoms' => 'required',
                'login' => 'required|string|unique:users',
                'email' => 'required|string|email|max:255|unique:users',
                // 'password' => 'required|min:8',
                'password' => [
                    'required', 
                    // 'confirmed', 
                    Password::min(8),
                    Password::min(8)->letters(),
                    Password::min(8)->mixedCase(),
                    Password::min(8)->numbers(),
                    Password::min(8)->symbols()
                ],
                'contact'=> 'required|string|min:10|max:14',
                // 'compagnie_id' => 'required',
                // 'proprietaire_id' => 'required',
                // 'type_user_id' => 'required',
                'type_user_id' => 'required|exists:App\Models\Type_user,id',
                // 'statut_id' => 'required',
                'statut_id' => 'required|exists:App\Models\Statut,id',
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'sexe' => 'required|in:Femme,Homme',
            ], $messages);
        // dd($validators->fails());
        $token = '';
        if(!$validators->fails()){
            // $compagnie = new compagnie;
            
            // dd($this->hasKeyExits($compagnie, "id", $request->compagne_id));
            $input = $request->all();
            $input['password'] = Hash::make($input['password']);
            $user = User::create($input);
            // dd($user);
            $validatedData['image'] = $request->file('image')->storeAs('user_photo', date("d/m/Y H:i:s").'-'.$user->id.'-'.$request->image->getClientOriginalName());
            $success['token'] = $user->createToken('users')->plainTextToken;
            // Envoyer un email à l'utilisateur avec le jeton d'authentification
            // Mail::to($user->email)->send(new BienvenueMail($accessToken));
            // $user->image = $validatedData['image'];
            unset($user['mot_passe']);
            $success['data'] = $user;

            return $this->sendResponse($success, 'Opération effectuée avec succès.');
        } else {
            // dd($validators->errors());
            return $this->sendError($validators->errors()->all(), ['error'=>'Utilisateur inexistant']);
        }
        // $validators = Validator::make($request->all(), [
        //     'name' => 'required|min:4',
        //     'email' => 'required|email',
        //     'password' => 'required|min:8',
        // ]);
        
  
        // return response()->json(['token' => $token], 200);
    }
  
    /**
     * Login Req
     */
    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
        // dd($request);
        // if (auth()->attempt($data)) {
        //     $token = auth()->user()->createToken('Laravel9PassportAuth')->accessToken;
        //     return response()->json(['token' => $token], 200);
        // } else {
        //     return response()->json(['error' => 'Unauthorised'], 401);
        // }
        // $val = $request->validated();
        $user = User::where('email', $request->email)->first();
        // dd($user);
        // 
        // $credentials = request(['email', 'password']);
        // dd(Auth::attempt(['email' => $request->email, 'password' => $request->password]));
        // if (!Auth::attempt($credentials)) {
        //     return response()->json([
        //         'message' => 'Login/mot de passe incorrecte',
        //     ], 401);
        // }
        // if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
        if($user){
            if(Hash::check($request->password, $user->password)){  
                // dd($user);
                Auth::login($user);
                // $user = Auth::user(); 
                $success['token'] = $user->createToken('users')->plainTextToken; 
                $success['data'] = $user;
                // $request->session()->regenerate();
                return $this->sendResponse($success, 'Opération effectuée avec succès.');
            } 
            else{ 
                // $errors = new MessageBag();
                // dd($errors->all ());
                return $this->sendError('Unauthorised.', ['error'=>'Login/mot de passe incorrecte !']);
            } 
        } else {
            return $this->sendError('Unauthorised.', ['error'=>'Ce compte n\'est inexistant']);
        }
    }

    /* 
        public function login(Request $request)
        {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if (Auth::attempt($request->only('email', 'password'))) {
                return redirect()->intended('/home');
            } else {
                return redirect()->back()->withErrors($errors->all());
            }
        }
     */

    public function logout(Request $request){
        $request->user()->token()->revoke();
        // Auth::logout();
        return response()->json(['Operation réussie' => 'Vous êtes bien deconnecté, Au revoir, à bientot!'], 200);
    }

 
    public function userInfo() 
    {
 
     $user = auth()->user();
      
     return response()->json(['user' => $user], 200);
 
    }
}
