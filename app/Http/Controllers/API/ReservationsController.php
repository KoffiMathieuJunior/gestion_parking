<?php

namespace App\Http\Controllers\API;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController;

class ReservationsController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $req = $request->all();
        $query = Reservation::join('place_stationnements', 'place_id', '=', 'place_stationnements.id')
                          ->join('parkings', 'reservations.parkings_id', '=', 'parkings.id')
                          ->join('users', 'client_id', '=', 'users.id')
                        //   ->join('formule', 'formule_id', '=', 'formule.id')
                          ->join('mode_paiements', 'mode_paiement_id', '=', 'mode_paiements.id')
                          ->select('reservations.id as id', 'statut', 'date_depart', 'heure_depart', 'date_arrive', 'heure_arrive',
                                    'parkings.id as parking_id', 'parkings.libelle as parking_libelle', 'tarif', 'reservations.code as code',
                                    'nom', 'prenoms', 'contact', 'email','mode_paiements.id as mode_paiement_id', 
                                    'mode_paiements.libelle as mode_paiement_libelle', 'place_id',
                                    'place_stationnements.libelle as place_libelle','place_stationnements.id as place_id');
        // dd($request->has('data'));
        if($request->has('data')){
            if ($request->has('data.statut')) {
                $query->where('reservations.statut', 'LIKE', '%' . $req['data']['statut'] . '%');
            }

            if ($request->has('data.tarif')) {
                $query->where('tarif', 'LIKE', '%' . $req['data']['tarif'] . '%');
            }
            
            if ($request->has('data.date_depart')) {
                $query->where('date_depart', 'LIKE', '%' . $req['data']['date_depart'] . '%');
            }

            if ($request->has('data.date_arrive')) {
                $query->where('date_arrive', 'LIKE', '%' . $req['data']['date_arrive'] . '%');
            }

            if ($request->has('data.heure_depart')) {
                $query->where('heure_depart', 'LIKE', '%' . $req['data']['heure_depart'] . '%');
            }

            if ($request->has('data.heure_arrive')) {
                $query->where('heure_arrive', 'LIKE', '%' . $req['data']['heure_arrive'] . '%');
            }

            if ($request->has('data.place_id')) {
                $query->where('reservations.place_id', $req['data']['place_id']);
            }

            if ($request->has('data.parkings_id')) {
                $query->where('reservations.parkings_id', $req['data']['parkings_id']);
            }

            if ($request->has('data.formule_id')) {
                $query->where('formule_id', $req['data']['formule_id']);
            }

            if ($request->has('data.client_id')) {
                $query->where('client_id', $req['data']['client_id']);
            }

            if ($request->has('data.mode_paiement_id')) {
                $query->where('reservations.mode_paiement_id', $req['data']['mode_paiement_id']);
            }

            /* Multi criteres */
            if ($request->has('data.query')) {
                $query->where('reservations.code', 'LIKE', '%' . $req['data']['query'] . '%')
                        ->orWhere('nom', 'LIKE', '%' . $req['data']['query'] . '%')
                        ->orWhere('prenoms', 'LIKE', '%' . $req['data']['query'] . '%')
                        ->orWhere('contact', 'LIKE', '%' . $req['data']['query'] . '%')
                        ->orWhere('email', 'LIKE', '%' . $req['data']['query'] . '%')
                        ->orWhere('tarif', 'LIKE', '%' . $req['data']['query'] . '%')
                        ->orWhere('statut', 'LIKE', '%' . $req['data']['query'] . '%');
            }
            

            if(isset($req['size'])){
                $results = $query->paginate($req['size']);
            } else {
                $results = $query->get();
            }

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

            'data.date_depart.required' => 'Le champs date de depart est requise et doit être au format H:i.',
            'data.date_depart.date_format' => 'Le champs date de depart doit être au format H:i.',
            'data.date_arrive.required' => 'Le champs date d\'arriver est requise et doit être au format H:i.',
            'data.date_arrive.date_format' => 'Le champs date d\'arriver doit être au format H:i.',

            'data.heure_depart.required' => 'Le champs heure de depart est requise et doit être au format H:i.',
            'data.heure_depart.date_format' => 'Le champs heure de depart doit être au format H:i.',
            'data.heure_arrive.required' => 'Le champs heure d\'arriver est requise et doit être au format H:i.',
            'data.heure_arrive.date_format' => 'Le champs heure d\'arriver doit être au format H:i.',

            'data.place_id.required' => 'Le champs place indiqué n\'est pas valide.',
            'data.place_id.integer' => 'Le champs place doit être un entier.',
            'data.place_id.exists' => 'Le champs place sélectionné n\'est pas valide.',
            'data.statut.required' => 'Le champs statut indiqué n\'est pas valide.',
            'data.statut.string' => 'Le champs statut doit être un entier.',
            // 'data.statut_id.exists' => 'Le champs statut sélectionné n\'est pas valide.',
            'data.client_id.required' => 'Le champs client indiqué n\'est pas valide.',
            'data.client_id.integer' => 'Le champs client doit être un entier.',
            'data.client_id.exists' => 'Le champs client sélectionné n\'est pas valide.',
            'data.parkings_id.required' => 'Le champs parkings indiqué n\'est pas valide.',
            'data.parkings_id.integer' => 'Le champs parkings doit être un entier.',
            'data.parkings_id.exists' => 'Le champs parkings sélectionné n\'est pas valide.',
            'data.mode_paiement_id.required' => 'Le champs mode de paiement indiqué n\'est pas valide.',
            'data.mode_paiement_id.integer' => 'Le champs mode de paiement doit être un entier.',
            'data.mode_paiement_id.exists' => 'Le champs mode de paiement sélectionné n\'est pas valide.',
            'data.formule_id.required' => 'Le champs formule indiqué n\'est pas valide.',
            'data.formule_id.integer' => 'Le champs formule doit être un entier.',
            'data.formule_id.exists' => 'Le champs formule sélectionné n\'est pas valide.',
        ];
        
        $req = $request->all();
        // dd($req);
        $validator = Validator::make($req, [
            'data' => 'required|array',
            'data.date_depart' => 'required|date_format:m/d/Y',
            'data.date_arrive' => 'required|date_format:m/d/Y|after_or_equal:date_depart',
            'data.heure_depart' => 'required|date_format:H:i:s',
            'data.heure_arrive' => 'required|date_format:H:i:s|after_or_equal:heure_depart',
            'data.place_id' => 'required|integer|exists:App\Models\Place_Stationnement,id',
            'data.statut' => 'required|in:waiting,cancel,new,finished,validate',
            'data.client_id' => 'required|integer|exists:App\Models\User,id',
            'data.mode_paiement_id' => 'required|integer|exists:App\Models\Mode_Paiement,id',
            'data.parkings_id' => 'integer|exists:App\Models\Parking,id',
            'data.formule_id' => 'integer',
        ], $messages);
        // dd($validator->passes());
        if($validator->passes()){
            // dd($req);
            $data = new Reservation([
                'code' => $this->generateReservationCode(),
                'date_depart' => $req['data']['date_depart'],
                'date_arrive' => $req['data']['date_arrive'],
                'heure_depart' => $req['data']['heure_depart'],
                'heure_arrive' => $req['data']['heure_arrive'],
                'place_id' => $req['data']['place_id'],
                'statut' => $req['data']['statut'],
                'client_id' => $req['data']['client_id'],
                'mode_paiement_id' => $req['data']['mode_paiement_id'],
                'parkings_id' => $req['data']['parkings_id'],
                'formule_id' => $req['data']['formule_id'],
            ]);
            
            // dd($data);
            $data->save();
            return $this->sendResponse($data, 'Opération effectuée avec succès.');
        } else {
            return $this->sendError($validator->errors()->all(), 'Operation echouée');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        // dd($request);
        $messages = [
            'data.date_depart.required' => 'Le champs date de depart est requise et doit être au format H:i.',
            'data.date_depart.date_format' => 'Le champs date de depart doit être au format H:i.',
            'data.date_arrive.required' => 'Le champs date d\'arriver est requise et doit être au format H:i.',
            'data.date_arrive.date_format' => 'Le champs date d\'arriver doit être au format H:i.',

            'data.heure_depart.required' => 'Le champs heure de depart est requise et doit être au format H:i.',
            'data.heure_depart.date_format' => 'Le champs heure de depart doit être au format H:i.',
            'data.heure_arrive.required' => 'Le champs heure d\'arriver est requise et doit être au format H:i.',
            'data.heure_arrive.date_format' => 'Le champs heure d\'arriver doit être au format H:i.',

            'data.place_id.required' => 'Le champs place indiqué n\'est pas valide.',
            'data.place_id.integer' => 'Le champs place doit être un entier.',
            'data.place_id.exists' => 'Le champs place sélectionné n\'est pas valide.',
            'data.statut.required' => 'Le champs statut indiqué n\'est pas valide.',
            'data.statut.string' => 'Le champs statut doit être un entier.',
            // 'data.statut_id.exists' => 'Le champs statut sélectionné n\'est pas valide.',
            'data.client_id.required' => 'Le champs client indiqué n\'est pas valide.',
            'data.client_id.integer' => 'Le champs client doit être un entier.',
            'data.client_id.exists' => 'Le champs client sélectionné n\'est pas valide.',
            'data.parkings_id.required' => 'Le champs parkings indiqué n\'est pas valide.',
            'data.parkings_id.integer' => 'Le champs parkings doit être un entier.',
            'data.parkings_id.exists' => 'Le champs parkings sélectionné n\'est pas valide.',
            'data.mode_paiement_id.required' => 'Le champs mode de paiement indiqué n\'est pas valide.',
            'data.mode_paiement_id.integer' => 'Le champs mode de paiement doit être un entier.',
            'data.mode_paiement_id.exists' => 'Le champs mode de paiement sélectionné n\'est pas valide.',
            'data.formule_id.required' => 'Le champs formule indiqué n\'est pas valide.',
            'data.formule_id.integer' => 'Le champs formule doit être un entier.',
            'data.formule_id.exists' => 'Le champs formule sélectionné n\'est pas valide.',
        ];
        $req = $request->all();
        // echo "Before Validator::make<br>";
        $validator = Validator::make($req, [
            'data' => 'required|array',
            'data.id' => 'required',
            'data.date_depart' => 'date_format:m/d/Y',
            'data.date_arrive' => 'date_format:m/d/Y|after_or_equals:date_depart',
            'data.heure_depart' => 'date_format:H:i',
            'data.heure_arrive' => 'date_format:H:i|after_or_equals:heure_depart',
            'data.place_id' => 'integer|exists:App\Models\Place_Stationnement,id',
            'data.statut' => 'in:waiting,cancel,new,finished,validate',
            // 'data.statut_id' => 'required|integer|exists:App\Models\Statut,id',
            'data.client_id' => 'integer|exists:App\Models\User,id',
            'data.mode_paiement_id' => 'integer|exists:App\Models\Mode_Paiement,id',
            'data.parkings_id' => 'integer|exists:App\Models\Parking,id',
            'data.formule_id' => 'integer|exists:App\Models\Formule,id',
        ], $messages);
        // dd($req);
        if($validator->passes()){
            $data = Reservation::findOrFail($req['data']['id']);
            $data->id = $req['data']['id'];
            if ($request->has('data.date_depart')) {
                $data->date_depart = $req['data']['date_depart'];
            }
            if ($request->has('data.date_arrive')) {
                $data->date_arrive = $req['data']['date_arrive'];
            }
            if ($request->has('data.heure_depart')) {
                $data->heure_depart = $req['data']['heure_depart'];
            }
            if ($request->has('data.heure_arrive')) {
                $data->heure_arrive = $req['data']['heure_arrive'];
            }
            if ($request->has('data.parkings_id')) {
                $data->parkings_id = $req['data']['parkings_id'];
            }
            if ($request->has('data.place_id')) {
                $data->place_id = $req['data']['place_id'];
            }
            if ($request->has('data.statut')) {
                $data->statut = $req['data']['statut'];
            }
            if ($request->has('data.client_id')) {
                $data->client_id = $req['data']['client_id'];
            }
            if ($request->has('data.mode_paiement_id')) {
                $data->mode_paiement_id = $req['data']['mode_paiement_id'];
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
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $req = $request->all();
        $data = Reservation::findOrFail($req['data']['id']);
        if(!$data->fails()){
            $data->delete();
            return $this->sendResponse($data, 'Opération effectuée avec succès.');
        } else {
            return $this->sendError($data->errors()->all(), 'Operation echouée');
        }
    }

    /* Generer les codes de reservation */
    private function generateReservationCode() {
        // Générer un identifiant unique basé sur la date et l'heure actuelles
        $timestamp = time();
        $code = 'RES-' . date('YmdHis', $timestamp);
    
        // Ajouter une partie aléatoire pour éviter les collisions de codes
        $randomPart = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 4);
        $code .= '-' . $randomPart;
    
        return $code;
    }
}
