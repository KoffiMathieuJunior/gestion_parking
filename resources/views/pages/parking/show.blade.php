@extends('layouts.master')


@section('content')

    <h1>LARAVEL CRUD</h1>


    <table class="table table-bordered">

        <tr>

            <th>LIBELLE:</th>
            <td>{{ $parking->libelle }}</td>

        </tr>

        <tr>
            <th>LATITUDE:</th>
            <td>{{ $parking->latitude }}</td>
        </tr>
        <tr>
            <th>LONGITUDE:</th>
            <td>{{ $parking->longitude }}</td>
        </tr>
        <tr>
            <th>ADRESSE:</th>
            <td>{{ $parking->adresse }}</td>
        </tr>
        <tr>
            <th>HEURE D'OUVERTURE:</th>
            <td>{{ $parking->heure_ouverture }}</td>
        </tr>

        <tr>
            <th>HEURE DE FERMETURE:</th>
            <td>{{ $parking->heure_fermeture }}</td>
        </tr>

        <tr>
            <th>COMPAGNIE:</th>
            <td>{{ $parking->compagnie_id }}</td>
        </tr>

    </table>

@endsection