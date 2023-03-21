@extends('layouts.master')


@section('content')


    <h1>MODIFIER CAPTEUR</h1>


    @if ($errors->any())

        <div class="alert alert-danger">

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>

    @endif

    <form method="post" action="{{ url('capteur/'. $capteur->id) }}" >
        @method('PATCH')
        @csrf


        <div class="form-group mb-3">

            <label for="libelle">LIBELLE:</label>
            <input type="text" class="form-control" id="libelle" placeholder="Entrer un libelle" name="libelle" value="{{ $capteur->libelle }}">

        </div>
        


        <div class="form-group mb-3">

            <label for="etat">ETAT:</label>
            <input type="text" class="form-control" id="etat" placeholder="Entrer un etat" name="etat" value="{{ $capteur->etat }}">

        </div>
        
        <div class="form-group mb-3">

            <label for="statut_id">STATUT:</label>
            <input type="text" class="form-control" id="statut_id" placeholder="Entrer un statut" name="statut_id" value="{{ $capteur->statut_id }}">

        </div>  

        <button type="submit" class="btn btn-primary">Enregistrer</button>

    </form>

@endsection