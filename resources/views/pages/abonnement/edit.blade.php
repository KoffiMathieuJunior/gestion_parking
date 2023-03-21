@extends('layouts.master')


@section('content')


    <h1>MODIFIER L'ABONNEMENT</h1>


    @if ($errors->any())

        <div class="alert alert-danger">

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>

    @endif

    <form method="post" action="{{ url('abonnement/'. $abonnement->id) }}" >
        @method('PATCH')
        @csrf


        <div class="form-group mb-3">

            <label for="code">CODE:</label>
            <input type="text" class="form-control" id="code" placeholder="Entrer un code" name="code" value="{{ $abonnement->code }}">

        </div>
        
        <div class="form-group mb-3">

            <label for="date_abonnement">DATE D'ABONNEMENT:</label>
            <input type="text" class="form-control" id="date_abonnement" placeholder="Entrer une date" name="date_abonnement" value="{{ $abonnement->date_abonnement }}">

        </div>


        <div class="form-group mb-3">

            <label for="libelle">LIBELLE:</label>
            <input type="text" class="form-control" id="libelle" placeholder="Entrer un libellé" name="libelle" value="{{ $abonnement->libelle }}">

        </div>

      

        <button type="submit" class="btn btn-primary">Enregistrer</button>

    </form>

@endsection