@extends('layouts.master')

    <div class="row">

        <div class="col-lg-11">

            <h2>CRUD LARAVEL</h2>

        </div>

        <div class="col-lg-1">
            <a class="btn btn-success" href="{{ url('compagnie/create') }}">Ajouter</a>
        </div>

    </div>

    <table class="table table-bordered">

        <tr>

            <th>ID</th>
            <th>LIBELLE</th>
            <th>CONTACT</th>
            <th>EMAIL</th>
            <th>ACTIONS</th>

        </tr>
              
        @php
            $compagnie = App\Models\Compagnie::all();
        @endphp

        @foreach ($compagnie as $index => $compagnie)

            <tr>
                <td>{{ $index }}</td>
                <td>{{ $compagnie->libelle }}</td>
                <td>{{ $compagnie->contact }}</td>
                <td>{{ $compagnie->email }}</td>
                <td>
                    <form action="{{ url('compagnie/'. $compagnie->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <a class="btn btn-info" href="{{ url('compagnie/'. $compagnie->id) }}">Voir</a>
                        <a class="btn btn-primary" href="{{ url('compagnie/'. $compagnie->id .'/edit') }}">Modifier</a>

                        <button type="submit" class="btn btn-danger">Supprimer</button>

                </td>

            </tr>

        @endforeach
    </table>


