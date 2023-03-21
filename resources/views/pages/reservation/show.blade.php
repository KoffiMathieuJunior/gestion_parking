@extends('layouts.master')


@section('content')

    <h1>LARAVEL CRUD</h1>


    <table class="table table-bordered">

        <tr>
            <th>DATE RESERVATION:</th>
            <td>{{ $reservation->date_reservation }}</td>
        </tr>

        <tr>
            <th>PLACE RESERVATION:</th>
            <td>{{ $reservation->place_stationnement_id }}</td>
        </tr>

        <tr>
            <th>DUREE RESERVATION:</th>
            <td>{{ $reservation->duree_reservation }}</td>
        </tr>

        <tr>
            <th>FORMULE:</th>
            <td>{{ $reservation->formule_id }}</td>
        </tr>

        <tr>
            <th>HEURE ARRIVE:</th>
            <td>{{ $reservation->heure_arrive }}</td>
        </tr>

        <tr>
            <th>HEURE DEPART:</th>
            <td>{{ $reservation->heure_depart }}</td>
        </tr>

        <tr>
            <th>CLIENT:</th>
            <td>{{ $reservation->client_id }}</td>
        </tr>

        <tr>
            <th>MODE PAIEMENT:</th>
            <td>{{ $reservation->mode_paiement_id }}</td>
        </tr>

    </table>

@endsection