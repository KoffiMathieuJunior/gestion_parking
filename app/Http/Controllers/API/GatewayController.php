<?php

namespace App\Http\Controllers\API;

use App\Models\Gateway;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use App\Http\Controllers\API\BaseController;

class GatewayController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $query = Gateway::query();
        $req = $request->all();
        // dd($request->has('data'));
        if($request->has('data')){
            if ($request->has('data.libelle')) {
                $query->where('libelle', 'LIKE', '%' . $req['data']['libelle'] . '%');
            }
            
            if ($request->has('data.code')) {
                $query->where('code', 'LIKE', '%' . $req['data']['code'] . '%');
            }

            if ($request->has('data.host')) {
                $query->where('host', 'LIKE', '%' . $req['data']['host'] . '%');
            }

            if ($request->has('data.ip')) {
                $query->where('ip', 'LIKE', '%' . $req['data']['ip'] . '%');
            }

            if ($request->has('data.username')) {
                $query->where('username', 'LIKE', '%' . $req['data']['username'] . '%');
            }

            if ($request->has('data.mot_passe')) {
                $query->where('mot_passe', 'LIKE', '%' . $req['data']['mot_passe'] . '%');
            }

            if ($request->has('data.niveaux_id')) {
                $query->where('niveaux_id', '=', $req['data']['niveaux_id']);
            }

            if ($request->has('data.config')) {
                $query->where('config', 'LIKE', '%' . $req['data']['config'] . '%');
            }

            $results = $query->paginate($request['size']);
            // dd($request);
            // unset($results['mot_passe']);
            if(!$results->isEmpty()){
                return $this->sendResponse($results, 'Opération effectuée avec succès.');
            } else {
                return $this->sendResponse([], 'Aucune donnée trouver');
            }
        } else{
            return $this->sendError('Format incorrect: data inexistant', 'Opération échouée');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $messages = [
            'data.libelle.required' => 'Ce champs est requis.',
            'data.code.required' => 'Ce champs est requise.',
            'data.host.required' => 'Ce champs est requis',
            'data.ip.required' => 'Ce champs est requise.',
            'data.ip.ip' => 'Ce champs ne respecte le format IP.',
            'data.username.required' => 'Ce champs est requise.',
            'data.username.regex' => 'Ce champs existe deja',
            'data.mot_passe.required' => 'Ce champs est requis',
            'data.mot_passe.min' => 'Ce champs doit comporter au moins 8 caractères',
            'data.mot_passe.letters' => 'Ce champs doit comporter au moins une lettre',
            'data.mot_passe.mixedCase' => 'Ce champs doit comporter au une lettre majuscule',
            'data.mot_passe.symbols' => 'Ce champs doit comporter des caractères spéciaux',
            'data.config.required' => 'Ce champs est requise.',
            'data.niveaux_id.required' => 'Le niveau indiqué n\'est pas valide.',
            'data.niveaux_id.integer' => 'Le niveau doit être un entier.',
            'data.niveaux_id.exists' => 'Le niveau sélectionné n\'est pas valide.',
        ];
        
        $req = $request->all();
        $validator = Validator::make($req, [
            'data' => 'required|array',
            'data.code' => 'required|string',
            'data.libelle' => 'required|string',
            'data.host' => 'required|string',
            'data.ip' => 'required|ip',
            'data.username' => 'required|string|unique:gateway,username',
            'data.mot_passe' => [
                'required', 
                // 'confirmed', 
                Password::min(8),
                Password::min(8)->letters(),
                Password::min(8)->mixedCase(),
                Password::min(8)->numbers(),
                Password::min(8)->symbols()
            ],
            'data.config' => 'required|string',
            'data.niveaux_id' => 'required|integer|exists:App\Models\Niveau,id',
        ], $messages);
        // dd($validator->passes());
        if($validator->passes()){
            // dd($req);
            $data = new Gateway([
                'code' => $req['data']['code'],
                'libelle' => $req['data']['libelle'],
                'host' => $req['data']['host'],
                'ip' => $req['data']['ip'],
                'config' => $req['data']['config'],
                'username' => $req['data']['username'],
                'mot_passe' => Hash::make($req['data']['mot_passe']),
                'niveaux_id' => $req['data']['niveaux_id'],
            ]);
            
            // dd($data);
            $data->save();
            unset($data['mot_passe']);
            return $this->sendResponse($data, 'Opération effectuée avec succès.');
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
        $messages = [
            'data.id.required' => 'Ce champs id est requis.',
            'data.code.required' => 'Ce champs est requise.',
            'data.host.required' => 'Ce champs est requis',
            'data.ip.required' => 'Ce champs est requise.',
            'data.ip.ip' => 'Ce champs ne respecte le format IP.',
            'data.username.required' => 'Ce champs username est requise.',
            'data.username.regex' => 'Ce champs existe deja',
            'data.mot_passe.required' => 'Ce champs est requis',
            'data.mot_passe.min' => 'Ce champs doit comporter au moins 8 caractères',
            'data.mot_passe.letters' => 'Ce champs doit comporter au moins une lettre',
            'data.mot_passe.mixedCase' => 'Ce champs doit comporter au une lettre majuscule',
            'data.mot_passe.symbols' => 'Ce champs doit comporter des caractères spéciaux',
            'data.config.required' => 'Ce champs est requise.',
            'data.niveaux_id.required' => 'Le niveau indiqué n\'est pas valide.',
            'data.niveaux_id.integer' => 'Le niveau doit être un entier.',
            'data.niveaux_id.exists' => 'Le niveau sélectionné n\'est pas valide.',
        ];
        $req = $request->all();
        // echo "Before Validator::make<br>";
        $validator = Validator::make($req, [
            'data' => 'required|array',
            'data.id' => 'required',
            'data.code' => 'string',
            'data.libelle' => 'integer',
            'data.host' => 'string',
            'data.ip' => 'ip',
            'data.username' => 'string|unique:gateway,username',
            'data.mot_passe' => [
                // 'confirmed', 
                Password::min(8),
                Password::min(8)->letters(),
                Password::min(8)->mixedCase(),
                Password::min(8)->numbers(),
                Password::min(8)->symbols()
            ],
            'data.config' => 'string',
            'data.niveaux_id' => 'integer|exists:App\Models\Niveau,id',
        ], $messages);
        // dd($req);
        if($validator->passes()){
            $data = Gateway::findOrFail($req['data']['id']);
            $data->id = $req['data']['id'];
            if ($request->has('data.code')) {
                $data->code = $req['data']['code'];
            }
            if ($request->has('data.libelle')) {
                $data->libelle = $req['data']['libelle'];
            }
            if ($request->has('data.host')) {
                $data->host = $req['data']['host'];
            }
            if ($request->has('data.ip')) {
                $data->ip = $req['data']['ip'];
            }
            if ($request->has('data.username')) {
                $data->username = $req['data']['username'];
            }
            if ($request->has('data.mot_passe')) {
                $data->mot_passe = Hash::make($req['data']['mot_passe']);
            }
            if ($request->has('data.config')) {
                $data->config = $req['data']['config'];
            }
            if ($request->has('data.niveaux_id')) {
                $data->niveaux_id = $req['data']['niveaux_id'];
            }
            $data->update();
            $data->save();
            unset($data['mot_passe']);
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
        $data = Gateway::findOrFail($req['data']['id']);
        if(!$data->fails()){
            $data->delete();
            return $this->sendResponse($data, 'Opération effectuée avec succès.');
        } else {
            return $this->sendError($data->errors()->all(), 'Operation echouée');
        }
    }
}
