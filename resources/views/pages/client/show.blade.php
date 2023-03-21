@extends('layouts.master')


@section('content')

    <h1>LARAVEL CRUD</h1>


    <table class="table table-bordered">

        <tr>
            <th>NOM:</th>
            <td>{{ $client->nom }}</td>
        </tr>
        
        <tr>
            <th>PRENOMS:</th>
            <td>{{ $client->prenoms }}</td>
        </tr>

        <tr>
            <th>code:</th>
            <td>{{ $client->code }}</td>
        </tr>


        <tr>

            <th>PHONE:</th>
            <td>{{ $client->phone }}</td>

        </tr>

        <tr>
            <th>EMAIL:</th>
            <td>{{ $client->email }}</td>
        </tr>

        <tr>
            <th>ABONNEMENT:</th>
            <td>{{ $client->abonnement_id }}</td>
        </tr>

    </table>

@endsection