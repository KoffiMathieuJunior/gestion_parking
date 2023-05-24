<?php

namespace App\Http\Controllers\API;

use App\Models\Proprietaire;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProprietaireController extends Controller
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
        // return Statut::where('libelle','like','%'.$req['data']['libelle'].'%')
      // ->orderBy('name')
      // ->take(10)
      // ->get();
      $data = Proprietaire::paginate($req['size']);
      if(!$data->isEmpty()){
            $path = storage_path('app/public/images/' . $data->logo);

            if (!file_exists($path)) {
                abort(404);
            }

            $file = file_get_contents($path);

            $type = mime_content_type($path);
            $data->logo = $file;
          return $this->sendResponse($data, 'Opération effectuée avec succès.');
      } else {
          return $this->sendResponse([], 'Aucune donnée trouver');
      }
    }

    /**
     * 
     * 
     */
    public function getImage(Request $request)
    {
        $data = Proprietaire::findOrFail($request['data']['id']);
        $path = storage_path('app/public/images/' . $data->logo);

        if (!file_exists($path)) {
            abort(404);
        }

        $file = file_get_contents($path);

        $type = mime_content_type($path);

        return response($file)->header('Content-Type', $type);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    /* 
        Ce service en particulier est en formData
    */
        //
        $req = $request->all();
        $validator = Validator::make($req, [
            // 'data' => 'required|array',
            'libelle' => 'required|string',
            'contact' => 'required|string|min:10|max:14',
            'email' => 'required|email|unique:users',
            'date_inscription' => 'required|date_format:H:i',
            'logo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'type_proprietaire_id' => 'required|integer|exists:App\Models\Type_proprietaire,id',
        ]);

        if($validator->passes()){
            $data = new Proprietaire($request->all());
            if ($request->hasFile('logo')) {
                $image = $request->file('logo');
                $filename = time() . '_' . $image->getClientOriginalName();
                $path = $image->storeAs('public/images', $filename);
                $data->logo = $filename;
            }
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
    public function show(Request $request)
    {
        //
        $req = $request->all();
        $validator = Validator::make($req, [
            'id' => 'required',
            'libelle' => 'required|string',
            'contact' => 'required|string|min:10|max:14',
            'email' => 'required|email|unique:users',
            'date_inscription' => 'required|date_format:H:i',
            'logo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'type_proprietaire_id' => 'required|integer|exists:App\Models\Type_proprietaire,id',
        ]);

        if($validator->passes()){
            $data = new Proprietaire($request->all());
            // Gestion de l'upload de l'image
            if ($request->hasFile('logo')) {
                $image = $request->file('logo');
                $filename = time() . '_' . $image->getClientOriginalName();
                $path = $image->storeAs('public/images', $filename);
                $data->logo = $filename;
            }
            // $data->image =   $request->file('logo')->storeAs('logo_proprietaire', date("d/m/Y H:i:s").'-'.$req['logo']->image->getClientOriginalName());
            $data->update();
            $data->save();
            return $this->sendResponse($data, 'Opération effectuée avec succès.');
        } else {
            return $this->sendError($validator->errors()->all(), 'Operation echouée');
        }
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
        $req = $request->all();
        $validator = Validator::make($req, [
            'id' => 'required',
            'libelle' => 'required|string',
            'contact' => 'required|string|min:10|max:14',
            'email' => 'required|email|unique:users',
            'date_inscription' => 'required|date_format:H:i',
            'logo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'type_proprietaire_id' => 'required|integer|exists:App\Models\Type_proprietaire,id',
        ]);

        if($validator->passes()){
            // $data = new Proprietaire($request->all());
            $data = Proprietaire::findOrFail($req['id']);
            $data->libelle = $req['libelle'];
            $data->contact = $req['contact'];
            $data->email = $req['email'];
            $data->logo = $req['logo'];
            $data->date_inscription = $req['date_inscription'];
            $data->type_proprietaire_id = $req['type_proprietaire_id'];
            $data->update();
            $data->save();
            return $this->sendResponse($data, 'Opération effectuée avec succès.');
        } else {
            return $this->sendError($validator->errors()->all(), 'Operation echouée');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
