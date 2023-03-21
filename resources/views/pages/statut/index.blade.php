@extends('layouts.master')

    <div class="row">

        <div class="col-lg-11">

            <h2>CRUD LARAVEL</h2>

        </div>

        <div class="col-lg-1">
            <a class="btn btn-success" href="{{ url('statut/create') }}">Ajouter</a>
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
            $statut = App\Models\Statut::all();
        @endphp

        @foreach ($statut as $index => $statut)

            <tr>
                <td>{{ $index }}</td>
                <td>{{ $statut->code }}</td>
                <td>{{ $statut->libelle }}</td>
                
                <td>

                    <form action="{{ url('statut/'. $statut->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <a class="btn btn-info" href="{{ url('statut/'. $statut->id) }}">Voir</a>
                        <a class="btn btn-primary" href="{{ url('statut/'. $statut->id .'/edit') }}">Modifier</a>

                        <button type="submit" class="btn btn-danger">Supprimer</button>

                </td>

            </tr>

        @endforeach
    </table>


