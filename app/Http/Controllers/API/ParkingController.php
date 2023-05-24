<?php

namespace App\Http\Controllers\API;

use App\Models\Parking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController;

class ParkingController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        //  $req = $request->all();
        //  $data = Parking::paginate($req['size']);
        // $users = Parking::query();
        $query = Parking::query();
        $req = $request->all();
        // dd($request->has('data'));
        if($request->has('data')){
            if ($request->has('data.libelle')) {
                $query->where('libelle', 'LIKE', '%' . $req['data']['libelle'] . '%');
            }
            
            if ($request->has('data.adresse')) {
                $query->where('adresse', 'LIKE', '%' . $req['data']['adresse'] . '%');
            }

            if ($request->has('data.latitude')) {
                $query->where('latitude', 'LIKE', '%' . $req['data']['latitude'] . '%');
            }

            if ($request->has('data.longitude')) {
                $query->where('longitude', 'LIKE', '%' . $req['data']['longitude'] . '%');
            }

            if ($request->has('data.ville_id')) {
                $query->where('ville_id', '=', $req['data']['ville_id']);
            }

            if ($request->has('data.proprietaire_id')) {
                $query->where('proprietaire_id', '=', $req['data']['proprietaire_id']);
            }
            // dd($request->has('data'));
            if ($request->has('data.jours')) {
                $query->where('jours', 'LIKE', '%' . $req['data']['jours'] . '%');
            }

            if ($request->has('data.heure_ouverture')) {
                $query->where('heure_ouverture', 'LIKE', '%' . $req['data']['heure_ouverture'] . '%');
            }

            if ($request->has('data.heure_fermeture')) {
                $query->where('heure_fermeture', 'LIKE', '%' . $req['data']['heure_fermeture'] . '%');
            }

            if ($request->has('data.heure_fermeture')) {
                $query->where('heure_fermeture', 'LIKE', '%' . $req['data']['heure_fermeture'] . '%');
            }

            $results = $query->paginate($request['size']);
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
            'data.libelle.required' => 'Le libelle est requis.',
            'data.adresse.required' => 'L\'adresse est requise.',
            'data.jours.required' => 'Les jours sont requis et doivent être séparés par des virgules.',
            'data.jours.regex' => 'Les jours doivent être des noms de jour de la semaine valides, séparés par des virgules.',
            'data.latitude.required' => 'La latitude est requise.',
            'data.latitude.regex' => 'La latitude doit être une valeur numérique valide.',
            'data.longitude.required' => 'La longitude est requise.',
            'data.longitude.regex' => 'La longitude doit être une valeur numérique valide.',
            'data.heure_ouverture.required' => 'L\'heure d\'ouverture est requise et doit être au format H:i.',
            'data.heure_ouverture.date_format' => 'L\'heure d\'ouverture doit être au format H:i.',
            'data.heure_fermeture.required' => 'L\'heure de fermeture est requise et doit être au format H:i.',
            'data.heure_fermeture.date_format' => 'L\'heure de fermeture doit être au format H:i.',
            'data.capacite_total.required' => 'La capacité totale est requise.',
            'data.capacite_total.integer' => 'La capacité totale doit être un entier.',
            'data.ville_id.required' => 'La ville est requise.',
            'data.ville_id.integer' => 'La ville doit être un entier.',
            'data.ville_id.exists' => 'La ville sélectionnée n\'est pas valide.',
            'data.proprietaire_id.required' => 'Le propriétaire est requis.',
            'data.proprietaire_id.integer' => 'Le propriétaire doit être un entier.',
            'data.proprietaire_id.exists' => 'Le propriétaire sélectionné n\'est pas valide.',
        ];
        $req = $request->all();
        $validator = Validator::make($req, [
            'data' => 'required|array',
            'data.libelle' => 'required|string',
            'data.adresse' => 'required|string',
            'data.jours' => ['required','string', 'regex:/^(\b(lundi|mardi|mercredi|jeudi|vendredi|samedi|dimanche)\b,?)+$/'],
            'data.latitude' => ['required','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'data.longitude' => ['required','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'data.heure_ouverture' => 'required|date_format:H:i',
            'data.heure_fermeture' => 'required|date_format:H:i',
            'data.capacite_total' => 'required|integer',
            'data.ville_id' => 'required|integer|exists:App\Models\Ville,id',
            'data.proprietaire_id' => 'required|integer|exists:App\Models\User,id',
        ], $messages);
        // dd($req);
        if($validator->passes()){
            $data = new Parking([
                'libelle' => $req['data']['libelle'],
                'adresse' => $req['data']['adresse'],
                'capacite_total' => $req['data']['capacite_total'],
                'jours' => $req['data']['jours'],
                'latitude' => $req['data']['latitude'],
                'longitude' => $req['data']['longitude'],
                'heure_ouverture' => $req['data']['heure_ouverture'],
                'heure_fermeture' => $req['data']['heure_fermeture'],
                'ville_id' => $req['data']['ville_id'],
                'proprietaire_id' => $req['data']['proprietaire_id'],
            ]);
            $data->save();
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
            'data.libelle.required' => 'Le libelle est requis.',
            'data.adresse.required' => 'L\'adresse est requise.',
            'data.jours.required' => 'Les jours sont requis et doivent être séparés par des virgules.',
            'data.jours.regex' => 'Les jours doivent être des noms de jour de la semaine valides, séparés par des virgules.',
            'data.latitude.required' => 'La latitude est requise.',
            'data.latitude.regex' => 'La latitude doit être une valeur numérique valide.',
            'data.longitude.required' => 'La longitude est requise.',
            'data.longitude.regex' => 'La longitude doit être une valeur numérique valide.',
            'data.heure_ouverture.required' => 'L\'heure d\'ouverture est requise et doit être au format H:i.',
            'data.heure_ouverture.date_format' => 'L\'heure d\'ouverture doit être au format H:i.',
            'data.heure_fermeture.required' => 'L\'heure de fermeture est requise et doit être au format H:i.',
            'data.heure_fermeture.date_format' => 'L\'heure de fermeture doit être au format H:i.',
            'data.capacite_total.required' => 'La capacité totale est requise.',
            'data.capacite_total.integer' => 'La capacité totale doit être un entier.',
            'data.ville_id.required' => 'La ville est requise.',
            'data.ville_id.integer' => 'La ville doit être un entier.',
            'data.ville_id.exists' => 'La ville sélectionnée n\'est pas valide.',
            'data.proprietaire_id.required' => 'Le propriétaire est requis.',
            'data.proprietaire_id.integer' => 'Le propriétaire doit être un entier.',
            'data.proprietaire_id.exists' => 'Le propriétaire sélectionné n\'est pas valide.',
        ];
        $req = $request->all();
        // echo "Before Validator::make<br>";
        $validator = Validator::make($req, [
            'data' => 'required|array',
            'data.id' => 'required',
            'data.libelle' => 'string',
            'data.adresse' => 'string',
            'data.jours' => ['string', 'regex:/^(\b(lundi|mardi|mercredi|jeudi|vendredi|samedi|dimanche)\b,?)+$/'],
            'data.latitude' => ['regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'data.longitude' => ['regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'data.heure_ouverture' => 'date_format:H:i',
            'data.heure_fermeture' => 'date_format:H:i',
            'data.capacite_total' => 'integer',
            'data.ville_id' => 'integer|exists:App\Models\Ville,id',
            'data.proprietaire_id' => 'integer|exists:App\Models\type_user,id',
        ], $messages);
        // dd($req);
        if($validator->passes()){
            $data = Parking::findOrFail($req['data']['id']);
            $data->id = $req['data']['id'];
            if ($request->has('data.libelle')) {
                $data->libelle = $req['data']['libelle'];
            }
            if ($request->has('data.adresse')) {
                $data->adresse = $req['data']['adresse'];
            }
            if ($request->has('data.jours')) {
                $data->jours = $req['data']['jours'];
            }
            if ($request->has('data.latitude')) {
                $data->latitude = $req['data']['latitude'];
            }
            if ($request->has('data.longitude')) {
                $data->longitude = $req['data']['longitude'];
            }
            if ($request->has('data.heure_ouverture')) {
                $data->heure_ouverture = $req['data']['heure_ouverture'];
            }
            if ($request->has('data.heure_fermeture')) {
                $data->heure_fermeture = $req['data']['heure_fermeture'];
            }
            if ($request->has('data.capacite_total')) {
                $data->capacite_total = $req['data']['capacite_total'];
            }
            if ($request->has('data.ville_id')) {
                $data->ville_id = $req['data']['ville_id'];
            }
            if ($request->has('data.proprietaire_id')) {
                $data->proprietaire_id = $req['data']['proprietaire_id'];
            }
            $data->update();
            $data->save();
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
        $data = Parking::findOrFail($req['data']['id']);
        if(!$data->fails()){
            $data->delete();
            return $this->sendResponse($data, 'Opération effectuée avec succès.');
        } else {
            return $this->sendError($data->errors()->all(), 'Operation echouée');
        }
    }
}
