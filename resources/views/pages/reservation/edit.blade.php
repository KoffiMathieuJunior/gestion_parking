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

    <form method="post" action="{{ url('reservation/'. $reservation->id) }}" >
        @method('PATCH')
        @csrf


        <div class="form-group mb-3">

            <label for="date_reservation">DATE DE RESERVATION:</label>
            <input type="text" class="form-control" id="date_reservation" placeholder="Entrer une date" name="date_reservation" value="{{ $reservation->date_reservation }}">

        </div>

        
        <div class="form-group mb-3">

            <label for="place_stationnement_id">PLACE STATIONNEMENT:</label>
            <input type="text" class="form-control" id="place_stationnement_id" placeholder="Entrer une place" name="place_stationnement_id" value="{{ $reservation->place_stationnement_id }}">

        </div>

        <div class="form-group mb-3">

            <label for="duree_reservation">DUREE RESERVATION:</label>
            <input type="text" class="form-control" id="duree_reservation" placeholder="Entrer une durée" name="duree_reservation" value="{{ $reservation->duree_reservation }}">

        </div>

        <div class="form-group mb-3">

            <label for="formule_id">FORMULE:</label>
            <input type="text" class="form-control" id="formule_id" placeholder="Entrer une formule" name="formule_id" value="{{ $reservation->formule_id }}">

        </div>

        <div class="form-group mb-3">

            <label for="heure_arrive">HEURE D'ARRIVEE:</label>
            <input type="text" class="form-control" id="heure_arrive" placeholder="Entrer une heure" name="heure_arrive" value="{{ $reservation->heure_arrive }}">

        </div>

        <div class="form-group mb-3">

            <label for="heure_depart">HEURE DE DEPART:</label>
            <input type="text" class="form-control" id="heure_depart" placeholder="Entrer une heure " name="heure_depart" value="{{ $reservation->heure_depart }}">

        </div>

        <div class="form-group mb-3">

            <label for="client_id">CLIENT:</label>
            <input type="text" class="form-control" id="client_id" placeholder="Entrer client " name="client_id" value="{{ $reservation->client_id }}">

        </div>

        <div class="form-group mb-3">

            <label for="mode_paiement_id">MODE DE PAIEMENT:</label>
            <input type="text" class="form-control" id="mode_paiement_id" placeholder="Entrer mode de paiement " name="mode_paiement_id" value="{{ $reservation->mode_paiement_id }}">

        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>

    </form>

@endsection