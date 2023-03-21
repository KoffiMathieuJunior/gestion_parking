@extends('layouts.master')

    <div class="row">

        <div class="col-lg-11">

            <h2>CRUD LARAVEL</h2>

        </div>

        <div class="col-lg-1">
            <a class="btn btn-success" href="{{ url('gateway/create') }}">Ajouter</a>
        </div>

    </div>

    <table class="table table-bordered">

        <tr>

            <th>ID</th>
            <th>CODE</th>
            <th>LIBELLE</th>
            <th>HOST</th>
            <th>MOT DE PASSE</th>
            <th>PARKING</th>
            <th>ACTIONS</th>

        </tr>
              
        @php
            $gateway = App\Models\Gateway::all();
        @endphp

        @foreach ($gateway as $index => $gateway)

            <tr>
                <td>{{ $index }}</td>
                <td>{{ $gateway->code }}</td>
                <td>{{ $gateway->libelle }}</td>
                <td>{{ $gateway->host }}</td>
                <td>{{ $gateway->mot_passe }}</td>
                <td>{{ $gateway->parking_id }}</td>
                <td>
                    <form action="{{ url('gateway/'. $gateway->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <a class="btn btn-info" href="{{ url('gateway/'. $gateway->id) }}">Voir</a>
                        <a class="btn btn-primary" href="{{ url('gateway/'. $gateway->id .'/edit') }}">Modifier</a>

                        <button type="submit" class="btn btn-danger">Supprimer</button>

                </td>

            </tr>

        @endforeach
    </table>


