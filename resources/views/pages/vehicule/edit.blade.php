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

    <form method="post" action="{{ url('vehicule/'. $vehicule->id) }}" >
        @method('PATCH')
        @csrf


        <div class="form-group mb-3">

            <label for="matricule">MATRICULE:</label>
            <input type="text" class="form-control" id="matricule" placeholder="Entrer" name="matricule" value="{{ $vehicule->matricule }}">

        </div>

        <div class="form-group mb-3">

            <label for="couleur">COULEUR:</label>
            <input type="text" class="form-control" id="couleur" placeholder="Entrer" name="couleur" value="{{ $vehicule->couleur }}">

        </div>

        <div class="form-group mb-3">

            <label for="marque">MARQUE:</label>
            <input type="text" class="form-control" id="marque" placeholder="Entrer" name="marque" value="{{ $vehicule->marque }}">

        </div>

        <div class="form-group mb-3">

            <label for="model">MODEL:</label>
            <input type="text" class="form-control" id="model" placeholder="Entrer" name="model" value="{{ $vehicule->model }}">

        </div>

        <div class="form-group mb-3">

            <label for="type_vehicule_id">TYPE VEHICULE:</label>
            <select type="text" class="form-control" id="type_vehicule_id" placeholder="Entrer" name="type_vehicule_id" value="{{ $vehicule->type_vehicule_id }}">

        </div>

        <div class="form-group mb-3">

            <label for="client_id">CLIENT:</label>
            <select type="text" class="form-control" id="client_id" placeholder="Entrer" name="client_id" value="{{ $vehicule->client_id }}">

        </div>

       

        <button type="submit" class="btn btn-primary">Enregistrer</button>

    </form>

@endsection