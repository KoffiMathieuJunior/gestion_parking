@extends('layouts.master')


@section('content')

    <h1>LARAVEL CRUD</h1>


    <table class="table table-bordered">

        <tr>
            <th>MATRICULE:</th>
            <td>{{ $vehicule->matricule }}</td>
        </tr>

        <tr>
            <th>COULEUR:</th>
            <td>{{ $vehicule->couleur }}</td>
        </tr>

        <tr>
            <th>MARQUE:</th>
            <td>{{ $vehicule->marque }}</td>
        </tr>

        <tr>
            <th>MODEL:</th>
            <td>{{ $vehicule->model }}</td>
        </tr>

        <tr>
            <th>TYPE VEHICULE:</th>
            <td>{{ $vehicule->type_vehicule_id }}</td>
        </tr>

        <tr>
            <th>CLIENT:</th>
            <td>{{ $vehicule->client_id }}</td>
        </tr>

    </table>

@endsection