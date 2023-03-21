@extends('layouts.master')


@section('content')

    <h1>LARAVEL CRUD</h1>


    <table class="table table-bordered">

        <tr>

            <th>LIBELLE:</th>
            <td>{{ $palce_stationnement->libelle }}</td>

        </tr>

        <tr>
            <th>CODE:</th>
            <td>{{ $palce_stationnement->etat }}</td>
        </tr>
        <tr>
            <th>NUMERO:</th>
            <td>{{ $palce_stationnement->numero }}</td>
        </tr>
        <tr>
            <th>TYPE VEHICULE:</th>
            <td>{{ $palce_stationnement->type_vehicule_id }}</td>
        </tr>
        <tr>
            <th>TYPE VEHICULE:</th>
            <td>{{ $palce_stationnement->parking_id }}</td>
        </tr>

        <tr>
            <th>CAPTEUR:</th>
            <td>{{ $palce_stationnement->capteur_id }}</td>
        </tr>


    </table>

@endsection