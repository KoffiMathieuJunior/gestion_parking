@extends('layouts.master')

    <div class="row">

        <div class="col-lg-11">

            <h2>CRUD LARAVEL</h2>

        </div>

        <div class="col-lg-1">
            <a class="btn btn-success" href="{{ url('vehicule/create') }}">Ajouter</a>
        </div>

    </div>

    <table class="table table-bordered">

        <tr>

            <th>ID</th>
            <th>MATRICULE</th>
            <th>COULEUR</th>
            <th>MARQUE</th>
            <th>MODEL</th>
            <th>TYPE VEHICULE</th>
            <th>CLIENT</th>
            <th>ACTIONS</th>

        </tr>
              
        @php
            $vehicule = App\Models\Vehicule::all();
        @endphp

        @foreach ($vehicule as $index => $vehicule)

            <tr>
                <td>{{ $index }}</td>
                <td>{{ $vehicule->matricule }}</td>
                <td>{{ $vehicule->couleur }}</td>
                <td>{{ $vehicule->marque }}</td>
                <td>{{ $vehicule->model }}</td>
                <td>{{ $vehicule->type_vehicule_id }}</td>
                <td>{{ $vehicule->client_id }}</td>
                <td>

                    <form action="{{ url('vehicule/'. $vehicule->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <a class="btn btn-info" href="{{ url('vehicule/'. $vehicule->id) }}">Voir</a>
                        <a class="btn btn-primary" href="{{ url('vehicule/'. $vehicule->id .'/edit') }}">Modifier</a>

                        <button type="submit" class="btn btn-danger">Supprimer</button>

                    </form>
                </td>

            </tr>

        @endforeach
    </table>


