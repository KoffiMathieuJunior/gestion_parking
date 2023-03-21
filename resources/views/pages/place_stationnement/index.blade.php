@extends('layouts.master')

    <div class="row">

        <div class="col-lg-11">

            <h2>CRUD LARAVEL</h2>

        </div>

        <div class="col-lg-1">
            <a class="btn btn-success" href="{{ url('place_stationnement/create') }}">Ajouter</a>
        </div>

    </div>

    <table class="table table-bordered">

        <tr>

            <th>ID</th>
            <th>LIBELLE</th>
            <th>ETAT</th>
            <th>NUMERO</th>
            <th>TYPE VEHICULE</th>
            <th>PARKING</th>
            <th>CAPTEUR</th>
            <th>ACTIONS</th>

        </tr>
              
        @php
            $place_stationnement = App\Models\Place_Stationnement::all();
        @endphp

        @foreach ($place_stationnement  as $index => $place_stationnement)

            <tr>
                <td>{{ $index }}</td>
                <td>{{ $place_stationnement->libelle }}</td>
                <td>{{ $place_stationnement->etat }}</td>
                <td>{{ $place_stationnement->numero }}</td>
                <td>{{ $place_stationnement->type_vehicule_id }}</td>
                <td>{{ $place_stationnement->parking_id }}</td>
                <td>{{ $place_stationnement->capteur_id }}</td>
                
                <td>
                    <form action="{{ url('place_stationnement/'. $place_stationnement->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <a class="btn btn-info" href="{{ url('place_stationnement/'. $place_stationnement->id) }}">Voir</a>
                        <a class="btn btn-primary" href="{{ url('place_stationnement/'. $reservation->id .'/edit') }}">Modifier</a>

                        <button type="submit" class="btn btn-danger">Supprimer</button>

                </td>

            </tr>

        @endforeach
    </table>


