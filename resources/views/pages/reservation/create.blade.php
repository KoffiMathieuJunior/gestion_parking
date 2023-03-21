@extends('layouts.master')


@section('content')

    <h1>AJOUTER</h1>


    @if ($errors->any())

        <div class="alert alert-danger">

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>

    @endif

    <form action="{{ url('reservation') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label for="date_reservation">DATE RESERVATION :</label>
            <input type="text" class="form-control" id="date_reservation" placeholder="Entrez une date de reservation" name="date_reservation">
        </div>

        
    
    <div class="form-group mb-3">
    <select id="place_stationnement_id" name="place_stationnement_id" class="form-control @error('place_stationnement_id') is-invalid @enderror"
     name="place_stationnement_id" value="{{ old('place_stationnement_id') }}" required autocomplete="place_stationnement_id">
     <option value="">Selectionner place stationnement</option>
    @foreach($data['place_stationnement'] as $item)
     <option value="{{$item->id}}">{{$item->libelle}}</option>
      @endforeach
    </select>
    </div>

        <div class="form-group mb-3">

            <label for="duree_reservation">DUREE RESERVATION:</label>
            <input type="text" class="form-control" id="duree_reservation" placeholder="duree_reservation" name="duree_reservation">

        </div>

        <div class="form-group mb-3">
            <select id="formule_id" name="formule_id" class="form-control @error('formule_id') is-invalid @enderror"
             name="formule_id" value="{{ old('formule_id') }}" required autocomplete="formule_id">
             <option value="">Selectionner formule</option>
            @foreach($data['formule'] as $item)
             <option value="{{$item->id}}">{{$item->libelle}}</option>
              @endforeach
            </select>
            </div>

        <div class="form-group mb-3">

            <label for="heure_arrive">HEURE D'ARRIVEE:</label>
            <input type="text" class="form-control" id="heure_arrive" placeholder="heure_arrive" name="heure_arrive">

        </div>

        <div class="form-group mb-3">

            <label for="heure_depart">HEURE DEPART:</label>
            <input type="text" class="form-control" id="heure_depart" placeholder="heure_depart" name="heure_depart">

        </div>

        <div class="form-group mb-3">
            <select id="client_id" name="client_id" class="form-control @error('client_id') is-invalid @enderror"
             name="client_id" value="{{ old('client_id') }}" required autocomplete="client_id">
             <option value="">Selectionner un client</option>
            @foreach($data['client'] as $item)
             <option value="{{$item->id}}">{{$item->nom}}</option>
              @endforeach
            </select>
            </div>

            <div class="form-group mb-3">
                <select id="mode_paiement_id" name="mode_paiement_id" class="form-control @error('mode_paiement_id') is-invalid @enderror"
                 name="mode_paiement_id" value="{{ old('mode_paiement_id') }}" required autocomplete="mode_paiement_id">
                 <option value="">Selectionner mode de paiement</option>
                @foreach($data['mode_paiement'] as $item)
                 <option value="{{$item->id}}">{{$item->libelle}}</option>
                  @endforeach
                </select>
                </div>


        <button type="submit" class="btn btn-primary">Enregister</button>

    </form>

@endsection