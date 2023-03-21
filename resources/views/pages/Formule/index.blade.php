@extends('layouts.master')

    <div class="row">

        <div class="col-lg-11">

            <h2>CRUD LARAVEL</h2>

        </div>

        <div class="col-lg-1">
            <a class="btn btn-success" href="{{ url('formule/create') }}">Ajouter</a>
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
            $formule = App\Models\Formule::all();
        @endphp

        @foreach ($formule as $index => $formule)

            <tr>
                <td>{{ $index }}</td>
                <td>{{ $formule->code }}</td>
                <td>{{ $formule->libelle }}</td>
                
                <td>

                    <form action="{{ url('formule/'. $formule->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <a class="btn btn-info" href="{{ url('formule/'. $formule->id) }}">Voir</a>
                        <a class="btn btn-primary" href="{{ url('formule/'. $formule->id .'/edit') }}">Modifier</a>

                        <button type="submit" class="btn btn-danger">Supprimer</button>


                </td>

            </tr>

        @endforeach
    </table>


