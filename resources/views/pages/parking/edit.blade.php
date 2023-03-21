@extends('layouts.master')


@section('content')


    <h1>MODIFIER</h1>


    @if ($errors->any())

        <div class="alert alert-danger">

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>

    @endif

    <form method="post" action="{{ url('parking/'. $parking->id) }}" >
        @method('PATCH')
        @csrf

        <div class="form-group mb-3">

            <label for="libelle">LIBELLE:</label>
            <input type="text" class="form-control" id="libelle" placeholder="Entrer un libellé" name="libelle" value="{{ $parking->libelle }}">

        </div>

        
        <div class="form-group mb-3">

            <label for="latitude">LATITUDE:</label>
            <input type="text" class="form-control" id="latitude" placeholder="latitude" name="latitude" value="{{ $parking->latitude }}">

        </div>

        
        <div class="form-group mb-3">

            <label for="longitude">LONGITUDE:</label>
            <input type="text" class="form-control" id="longitude" placeholder="longitude" name="longitude" value="{{ $parking->longitude }}">

        </div>

        
        <div class="form-group mb-3">

            <label for="adresse">ADRESSE:</label>
            <input type="text" class="form-control" id="adresse" placeholder="adresse" name="adresse" value="{{ $parking->adresse }}">

        </div>

        
        <div class="form-group mb-3">

            <label for="heure_ouverture">HEURE D'OUVERTURE:</label>
            <input type="text" class="form-control" id="heure_ouverture" placeholder="heure_ouverture" name="heure_ouverture" value="{{ $parking->heure_ouverture }}">

        </div>

        <div class="form-group mb-3">

            <label for="heure_fermeture">HEURE DE FERMETURE:</label>
            <input type="text" class="form-control" id="heure_fermeture" placeholder="heure_fermeture" name="heure_fermeture" value="{{ $parking->heure_fermeture }}">

        </div>

        <div class="form-group mb-3">

            <label for="compagnie_id">COMPAGNIE:</label>
            <input type="text" class="form-control" id="compagnie_id" placeholder="compagnie_id" name="compagnie_id" value="{{ $parking->compagnie_id }}">

        </div>


       
              

        <button type="submit" class="btn btn-primary">Enregistrer</button>

    </form>

@endsection