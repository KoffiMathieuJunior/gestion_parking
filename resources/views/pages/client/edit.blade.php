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

    <form method="post" action="{{ url('client/'. $client->id) }}" >
        @method('PATCH')
        @csrf


        <div class="form-group mb-3">

            <label for="nom">NOM:</label>
            <input type="text" class="form-control" id="nom" placeholder="Entrer" name="nom" value="{{ $client->nom }}">

        </div>

        <div class="form-group mb-3">

            <label for="prenoms">PRENOMS:</label>
            <input type="text" class="form-control" id="prenoms" placeholder="Entrer" name="prenoms" value="{{ $client->prenoms }}">

        </div>

        <div class="form-group mb-3">

            <label for="code">CODE:</label>
            <input type="text" class="form-control" id="code" placeholder="Entrer" name="code" value="{{ $client->CODE }}">

        </div>

        <div class="form-group mb-3">

            <label for="phone">PHONE:</label>
            <input type="text" class="form-control" id="phone" placeholder="Entrer" name="phone" value="{{ $client->phone }}">

        </div>

        <div class="form-group mb-3">

            <label for="email">EMAIL:</label>
            <input type="text" class="form-control" id="email" placeholder="Entrer" name="email" value="{{ $client->email }}">

        </div>

        <div class="form-group mb-3">

            <label for="mot_passe">MOT DE PASSE:</label>
            <input type="text" class="form-control" id="mot_passe" placeholder="Entrer" name="mot_passe" value="{{ $client->mot_passe }}">

        </div>

        
        <div class="form-group mb-3">

            <label for="abonnement_id">ABONNEMENT:</label>
            <input type="text" class="form-control" id="abonnement_id" placeholder="Entrer" name="abonnement_id" value="{{ $client->abonnement_id }}">

        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>

    </form>

@endsection