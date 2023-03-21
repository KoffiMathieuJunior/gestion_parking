@extends('layouts.master')

    <div class="row">

        <div class="col-lg-11">

            <h2>CRUD LARAVEL</h2>

        </div>

        <div class="col-lg-1">
            <a class="btn btn-success" href="{{ url('proprietaire/create') }}">Ajouter</a>
        </div>

    </div>

    <table class="table table-bordered">

        <tr>

            <th>ID</th>
            <th>LIBELLE</th>
            <th>CONTACT</th>
            <th>EMAIL</th>
            <th>DATE INSCRIPTION</th>
            <th>LOGO</th>
            <th>TYPE PROPRIETAIRE</th>
            <th>ACTIONS</th>

        </tr>
              
        @php
            $proprietaire = App\Models\Proprietaire::all();
        @endphp

        @foreach ($proprietaire as $index => $proprietaire)

            <tr>
                <td>{{ $index }}</td>
                <td>{{ $proprietaire->libelle }}</td>
                <td>{{ $proprietaire->contact }}</td>
                <td>{{ $proprietaire->email }}</td>
                <td>{{ $proprietaire->date_inscription }}</td>
                <td>{{ $proprietaire->logo }}</td>
                <td>{{ $proprietaire->type_proprietaire_id }}</td>
                
                <td>

                    <form action="{{ url('proprietaire/'. $proprietaire->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <a class="btn btn-info" href="{{ url('proprietaire/'. $proprietaire->id) }}">Voir</a>
                        <a class="btn btn-primary" href="{{ url('proprietaire/'. $proprietaire->id .'/edit') }}">Modifier</a>

                        <button type="submit" class="btn btn-danger">Supprimer</button>

                </td>

            </tr>

        @endforeach
    </table>


