@extends('layouts.master')

    <div class="row">

        <div class="col-lg-11">

            <h2>CRUD LARAVEL</h2>

        </div>

        <div class="col-lg-1">
            <a class="btn btn-success" href="{{ url('parking/create') }}">Ajouter</a>
        </div>

    </div>

    <table class="table table-bordered">

        <tr>

            <th>ID</th>
            <th>LIBELLE</th>
            <th>LATITUDE</th>
            <th>LONGITUDE</th>
            <th>ADRESSE</th>
            <th>HEURE D'OUVERTURE</th>
            <th>HEURE DE FERMETURE</th>
            <th>COMPAGNIE</th>
            <th>ACTIONS</th>

        </tr>
              
        @php
            $parking = App\Models\Parking::all();
        @endphp

        @foreach ($parking as $index => $parking)

            <tr>
                <td>{{ $index }}</td>
                <td>{{ $parking->libelle }}</td>
                <td>{{ $parking->latitude }}</td>
                <td>{{ $parking->longitude }}</td>
                <td>{{ $parking->adresse }}</td>
                <td>{{ $parking->heure_ouverture }}</td>
                <td>{{ $parking->heure_fermeture }}</td>
                <td>{{ $parking->compagnie_id }}</td>
                
                <td>

                    <form action="{{ url('parking/'. $parking->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <a class="btn btn-info" href="{{ url('parking/'. $parking->id) }}">Voir</a>
                        <a class="btn btn-primary" href="{{ url('parking/'. $parking->id .'/edit') }}">Modifier</a>

                        <button type="submit" class="btn btn-danger">Supprimer</button>

                </td>

            </tr>

        @endforeach
    </table>


