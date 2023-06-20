<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Place_Stationnement;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController;

class PlaceStationnementController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        // $query = Place_Stationnement::join('type_vehicules', 'place_stationnements.type_vehicule_id', '=', 'type_vehicules.id')
        //         ->join('niveaux', 'place_stationnements.niveaux_id', '=', 'niveaux.id')
        //         ->join('statuts', 'place_stationnements.statut_id', '=', 'statuts.id')
        //         ->join('capteurs', 'place_stationnements.capteur_id', '=', 'capteurs.id')
        //         ->join('parkings', 'niveaux.parking_id', '=', 'parkings.id')
        //         ->select('place_stationnements.id as id', 'place_stationnements.libelle as libelle', 'place_stationnements.numero as numero',
        //           'capteur_id', 'place_stationnements.niveaux_id as niveaux_id', 'place_stationnements.statut_id as statut_id',
        //           'statuts.libelle as statuts_libelle', 'abonnement_id', 'capteurs.libelle as capteur_libelle', 
        //           'type_vehicules.libelle as type_vehicule_libelle', 'parkings.libelle as parking_libelle', 'parkings.id as parking_id',
        //         DB::raw('ST_AsGeoJSON(place_stationnements.espace) as espace_geojson'), 'place_stationnements.type_vehicule_id');
       
        $query = Place_Stationnement::join('type_vehicules', 'place_stationnements.type_vehicule_id', '=', 'type_vehicules.id')
                ->join('niveaux', 'place_stationnements.niveaux_id', '=', 'niveaux.id')
                ->join('statuts', 'place_stationnements.statut_id', '=', 'statuts.id')
                // ->join('capteurs', 'place_stationnements.capteur_id', '=', 'capteurs.id')
                ->join('parkings', 'niveaux.parking_id', '=', 'parkings.id')
                ->select('place_stationnements.id as id', 'place_stationnements.libelle as libelle', 'place_stationnements.numero as numero',
                  /*'capteur_id',*/ 'place_stationnements.niveaux_id as niveaux_id', 'place_stationnements.statut_id as statut_id',
                  'statuts.libelle as statuts_libelle','parkings.libelle as parking_libelle', 'parkings.id as parking_id',
                  'type_vehicules.libelle as type_vehicule_libelle', 'place_stationnements.espace as espace_geojson', 'place_stationnements.type_vehicule_id');
        $req = $request->all();
        // dd($request->has('data'));
        if($request->has('data')){
            if ($request->has('data.libelle')) {
                $query->where('place_stationnements.libelle', 'LIKE', '%' . $req['data']['libelle'] . '%');
            }
            
            if ($request->has('data.numero')) {
                $query->where('place_stationnements.numero', 'LIKE', '%' . $req['data']['numero'] . '%');
            }

            if ($request->has('data.espace')) {
                $query->where('espace', 'LIKE', '%' . $req['data']['espace'] . '%');
            }

            if ($request->has('data.type_vehicule_id')) {
                $query->where('type_vehicule_id', $req['data']['type_vehicule_id']);
            }

            // if ($request->has('data.capteur_id')) {
            //     $query->where('capteur_id', '=', $req['data']['capteur_id']);
            // }

            if ($request->has('data.parking_id')) {
                $query->where('parkings.id', $req['data']['parking_id']);
            }

            if ($request->has('data.niveaux_id')) {
                $query->where('place_stationnements.niveaux_id',  $req['data']['niveaux_id']);
            }

            if ($request->has('data.statut_id')) {
                $query->where('place_stationnements.statut_id', $req['data']['statut_id']);
            }

            // if ($request->has('data.abonnement_id')) {
            //     $query->where('abonnement_id', '=', $req['data']['abonnement_id']);
            // }

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
        // dd($request);
        $messages = [
            'data.libelle.required' => 'Le libelle est requis.',
            'data.numero.required' => 'Le numero est requis.',
            'data.espace.required' => 'L\'espace sont requis et doivent être séparés par des virgules.',
            // 'data.espace.regex' => 'Mauvais formatage des coordonnés',
            'data.niveaux_id.required' => 'Le niveau est requis.',
            'data.niveaux_id.integer' => 'Le niveaux doit être un entier.',
            'data.niveaux_id.exists' => 'Le niveaux sélectionné n\'est pas valide.',
            // 'data.capteur_id.required' => 'Le capteur est requis.',
            // 'data.capteur_id.integer' => 'Le capteur doit être un entier.',
            // 'data.capteur_id.exists' => 'Le capteur sélectionné n\'est pas valide.',
            // 'data.abonnement_id.required' => 'L\'abonnement est requis.',
            // 'data.abonnement_id.integer' => 'L\'abonnement doit être un entier.',
            // 'data.abonnement_id.exists' => 'L\'abonnement sélectionné n\'est pas valide.',
            'data.type_vehicule_id.required' => 'Le type vehicule est requis.',
            'data.type_vehicule_id.integer' => 'Le type vehicule doit être un entier.',
            'data.type_vehicule_id.exists' => 'Le type vehicule sélectionné n\'est pas valide.',
        ];
        $req = $request->all();
       
        $validator = Validator::make($req, [
            'data' => 'required|array',
            'data.libelle' => 'required|string',
            'data.numero' => 'required|integer',
            'data.espace' => 'required|json',
            // 'data.espace' => 'required|json|regex:/^\{"type":"Polygon","coordinates":\[\[\[-?\d+(\.\d+)?,-?\d+(\.\d+)?\],?\]\]+\}$/',
            // 'data.espace' => ['required', 'geojson', new Polygon],
            // 'data.espace' => [
            //     'required',
            //     'string',
            //     'regex:/^\{"type":"Polygon","coordinates":\[\[(?:\[[-+]?\d+(?:\.\d+)?,-?[-+]?\d+(?:\.\d+)?\],?)+\]\]\}$/'
            // ],
            // 'data.espace' => [
            //     'required',
            //     'regex:/^POLYGON\s*\(\(\s*(\d+(\.\d+)?)\s+(\d+(\.\d+)?)\s*(,\s*\d+(\.\d+)?)?\s*(\d+(\.\d+)?)\s*\)\s*\)$/i'
            // ],
            'data.type_vehicule_id' => 'required|integer|exists:App\Models\Type_Vehicule,id',
            // 'data.abonnement_id' => 'required|integer|exists:App\Models\Abonnement,id',
            'data.niveaux_id' => 'required|integer|exists:App\Models\Niveau,id',
            // 'data.niveaux_id' => 'required|integer|exists:App\Models\Niveau,id',
            // 'data.capteur_id' => 'required|integer|exists:App\Models\Capteur,id',
            'data.statut_id' => 'required|integer|exists:App\Models\Statut,id',
        ], $messages);
        // dd($validator->passes());
        if($validator->passes()){
            $json = json_encode($req['data']['espace']);
            // dd($json);
            // $espace = DB::raw("ST_GeomFromGeoJSON('$json')");
            // $espace = DB::raw("ST_GeomFromText('" . $json . "')");
            // dd($espace);
            $data = new Place_Stationnement([
                'libelle' => $req['data']['libelle'],
                'numero' => $req['data']['numero'],
                'espace' => $req['data']['espace'],
                // 'espace' => $espace,
                'type_vehicule_id' => $req['data']['type_vehicule_id'],
                // 'abonnement_id' => $req['data']['abonnement_id'],
                'statut_id' => $req['data']['statut_id'],
                // 'capteur_id' => $req['data']['capteur_id'],
                'niveaux_id' => $req['data']['niveaux_id'],
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
    public function update(Request $request, $id)
    {
        //
        $messages = [
            'data.libelle.required' => 'Le libelle est requis.',
            'data.numero.required' => 'Le numero est requis.',
            'data.espace.required' => 'L\'espace est requis',
            'data.espace.json' => 'L\'espace doit etre une chaine de json',
            'data.niveaux_id.required' => 'Le niveau est requis.',
            'data.niveaux_id.integer' => 'Le niveaux doit être un entier.',
            'data.niveaux_id.exists' => 'Le niveaux sélectionné n\'est pas valide.',
            // 'data.capteur_id.required' => 'Le capteur est requis.',
            // 'data.capteur_id.integer' => 'Le capteur doit être un entier.',
            // 'data.capteur_id.exists' => 'Le capteur sélectionné n\'est pas valide.',
            // 'data.abonnement_id.required' => 'L\'abonnement est requis.',
            // 'data.abonnement_id.integer' => 'L\'abonnement doit être un entier.',
            // 'data.abonnement_id.exists' => 'L\'abonnement sélectionné n\'est pas valide.',
            'data.type_vehicule_id.required' => 'Le type vehicule est requis.',
            'data.type_vehicule_id.integer' => 'Le type vehicule doit être un entier.',
            'data.type_vehicule_id.exists' => 'Le type vehicule sélectionné n\'est pas valide.',
        ];
        $req = $request->all();
        // echo "Before Validator::make<br>";
        $validator = Validator::make($req, [
            'data' => 'required|array',
            'data.id' => 'required',
            'data.libelle' => 'required|string',
            'data.numero' => 'required|integer',
            'data.espace' => 'json',
            // 'data.espace' => [
            //     'required',
            //     'regex:/^POLYGON\s*\(\(\s*(\d+(\.\d+)?)\s+(\d+(\.\d+)?)\s*(,\s*\d+(\.\d+)?)?\s*(\d+(\.\d+)?)\s*\)\s*\)$/i'
            // ],
            'data.type_vehicule_id' => 'required|integer|exists:App\Models\Type_Vehicule,id',
            // 'data.abonnement_id' => 'required|integer|exists:App\Models\Abonnement,id',
            'data.niveaux_id' => 'required|integer|exists:App\Models\Niveau,id',
            // 'data.capteur_id' => 'required|integer|exists:App\Models\Capteur,id',
            'data.statut_id' => 'required|integer|exists:App\Models\Statut,id',
        ], $messages);
        // dd($req);
        if($validator->passes()){
            $data = Place_Stationnement::findOrFail($req['data']['id']);
            $data->id = $req['data']['id'];
            $data->libelle = $req['data']['libelle'];
            $data->numero = $req['data']['numero'];
            $data->espace = $req['data']['espace'];
            // $data->abonnement_id = $req['data']['abonnement_id'];
            // $data->capteur_id = $req['data']['capteur_id'];
            $data->statut_id = $req['data']['statut_id'];
            $data->niveaux_id = $req['data']['niveaux_id'];
            $data->type_vehicule_id = $req['data']['type_vehicule_id'];
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
        $data = Place_Stationnement::findOrFail($req['data']['id']);
        if(!$data->fails()){
            $data->delete();
            return $this->sendResponse($data, 'Opération effectuée avec succès.');
        } else {
            return $this->sendError($data->errors()->all(), 'Operation echouée');
        }
    }
}
