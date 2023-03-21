@extends('layouts.master')

    <div class="row">

        <div class="col-lg-11">

            <h2>CRUD LARAVEL</h2>

        </div>

        <div class="col-lg-1">
            <a class="btn btn-success" href="{{ url('client/create') }}">Ajouter</a>
        </div>

    </div>

    <table class="table table-bordered">

        <tr>

            <th>ID</th>
            <th>NOM</th>
            <th>PRENOMS</th>
            <th>CODE</th>
            <th>PHONE</th>
            <th>EMAIL</th>
            <th>MOT DE PASSE</th>
            <th>ABONNEMENT</th>
            <th>ACTIONS</th>

        </tr>
              
        @php
            $client = App\Models\Client::all();
        @endphp

        @foreach ($client as $index => $client)

            <tr>
                <td>{{ $index }}</td>
                <td>{{ $client->nom }}</td>
                <td>{{ $client->prenoms }}</td>
                <td>{{ $client->code }}</td>
                <td>{{ $client->phone }}</td>
                <td>{{ $client->email }}</td>
                <td>{{ $client->mot_passe }}</td>
                <td>{{ $client->abonnement_id }}</td>
                <td>

                    <form action="{{ url('client/'. $client->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <a class="btn btn-info" href="{{ url('client/'. $client->id) }}">Voir</a>
                        <a class="btn btn-primary" href="{{ url('client/'. $client->id .'/edit') }}">Modifier</a>

                        <button type="submit" class="btn btn-danger">Supprimer</button>

                    </form>
                </td>

            </tr>

        @endforeach
    </table>


