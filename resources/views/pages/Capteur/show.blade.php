
<form action="http://127.0.0.1:8000/capteur/">
                        <button type="submit" class="btn btn-add-domotel py-2">Valider</button>
            
$data=[];

      $data["capteur"]= Capteur::all(); 
      $capteur= Capteur::all();
      $data["statut"]=Statut::all();
      $data["gateway"]=Gateway::all();

      return view('pages.capteur.index',compact('data')); $data=[];

      $data["capteur"]= Capteur::all(); 
      $capteur= Capteur::all();
      $data["statut"]=Statut::all();
      $data["gateway"]=Gateway::all();
      

      return view('pages.capteur.index',compact('data'));