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

    <form action="{{ url('vehicule') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label for="matricule">MATRICULE :</label>
            <input type="text" class="form-control" id="matricule" placeholder="Entrez le matricule" name="matricule">
        </div>

        <div class="form-group mb-3">

            <label for="couleur">COULEUR:</label>
            <input type="text" class="form-control" id="couleur" placeholder="couleur" name="couleur">

        </div>

        <div class="form-group mb-3">

            <label for="marque">MARQUE:</label>
            <input type="text" class="form-control" id="marque" placeholder="marque" name="marque">

        </div>
        <div class="form-group mb-3">

            <label for="model">MODEL:</label>
            <input type="text" class="form-control" id="model" placeholder="model" name="model">

        </div>
        <div class="form-group mb-3">
        <select id="type_vehicule_id" name="type_vehicule_id" class="form-control @error('type_vehicule_id') is-invalid @enderror"
         name="type_vehicule_id" value="{{ old('type_vehicule_id') }}" required autocomplete="type_vehicule_id">
         <option value="">Selectionner type vehicule</option>
        @foreach($data['type_vehicule'] as $item)
         <option value="{{$item->id}}">{{$item->libelle}}</option>
          @endforeach
        </select>

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
         <button type="submit" class="btn btn-primary">Enregister</button>
      </div>
    </form>

@endsection