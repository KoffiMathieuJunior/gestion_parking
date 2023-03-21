@extends('layouts.master')

    <div class="row">

        <div class="col-lg-11">

            <h2>CRUD LARAVEL</h2>

        </div>

        <div class="col-lg-1">
            <a class="btn btn-success" href="{{ url('type_proprietaire/create') }}">Ajouter</a>
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
            $type_proprietaire = App\Models\Type_Proprietaire::all();
        @endphp

        @foreach ($type_proprietaire as $index => $type_proprietaire)

            <tr>
                <td>{{ $index }}</td>
                <td>{{ $type_proprietaire->code }}</td>
                <td>{{ $type_proprietaire->libelle }}</td>
                
                <td>

                    <form action="{{ url('type_proprietaire/'. $type_proprietaire->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <a class="btn btn-info" href="{{ url('type_proprietaire/'. $type_proprietaire->id) }}">Voir</a>
                        <a class="btn btn-primary" href="{{ url('type_proprietaire/'. $type_proprietaire->id .'/edit') }}">Modifier</a>

                        <button type="submit" class="btn btn-danger">Supprimer</button>

                </td>

            </tr>

        @endforeach
    </table>


