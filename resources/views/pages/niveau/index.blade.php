@extends('layouts.master')

    <div class="row">

        <div class="col-lg-11">

            <h2>CRUD LARAVEL</h2>

        </div>

        <div class="col-lg-1">
            <a class="btn btn-success" href="{{ url('niveau/create') }}">Ajouter</a>
        </div>

    </div>

    <table class="table table-bordered">

        <tr>

            <th>ID</th>
            <th>CODE</th>
            <th>LIBELLE</th>
            <th>ACTIONS</th>

        </tr>
              
        @php
            $niveau = App\Models\Niveau::all();
        @endphp

        @foreach ($niveau as $index => $niveau)

            <tr>
                <td>{{ $index }}</td>
                <td>{{ $niveau->code }}</td>
                <td>{{ $niveau->libelle }}</td>
                
                <td>

                    <form action="{{ url('niveau/'. $niveau->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <a class="btn btn-info" href="{{ url('niveau/'. $niveau->id) }}">Voir</a>
                        <a class="btn btn-primary" href="{{ url('niveau/'. $niveau->id .'/edit') }}">Modifier</a>

                        <button type="submit" class="btn btn-danger">Supprimer</button>

                </td>

            </tr>

        @endforeach
    </table>


