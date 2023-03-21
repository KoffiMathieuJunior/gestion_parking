@extends('layouts.master')

    <div class="row">

        <div class="col-lg-11">

            <h2>CRUD LARAVEL</h2>

        </div>

        <div class="col-lg-1">
            <a class="btn btn-success" href="{{ url('reservation/create') }}">Ajouter</a>
        </div>

    </div>

    <table class="table table-bordered">

        <tr>

            <th>ID</th>
            <th>DATE RESERVATION</th>
            <th>PLACE STATIONNEMENT</th>
            <th>DUREE RESERVATION</th>
            <th>FORMULE</th>
            <th>HEURE ARRIVEE</th>
            <th>HEURE DEPART</th>
            <th>CLIENT</th>
            <th>MODE PAIEMENT</th>
            <th>ACTIONS</th>

        </tr>
              
        @php
            $reservation = App\Models\Reservation::all();
        @endphp

        @foreach ($reservation as $index => $reservation)

            <tr>
                <td>{{ $index }}</td>
                <td>{{ $reservation->date_reservation }}</td>
                <td>{{ $reservation->place_stationnement_id }}</td>
                <td>{{ $reservation->duree_reservation }}</td>
                <td>{{ $reservation->formule_id }}</td>
                <td>{{ $reservation->heure_arrive }}</td>
                <td>{{ $reservation->heure_depart }}</td>
                <td>{{ $reservation->client_id }}</td>
                <td>{{ $reservation->mode_paiement_id }}</td>
                
                <td>

                    <form action="{{ url('reservation/'. $reservation->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <a class="btn btn-info" href="{{ url('reservation/'. $reservation->id) }}">Voir</a>
                        <a class="btn btn-primary" href="{{ url('reservation/'. $reservation->id .'/edit') }}">Modifier</a>

                        <button type="submit" class="btn btn-danger">Supprimer</button>
                </td>

            </tr>

        @endforeach
    </table>


