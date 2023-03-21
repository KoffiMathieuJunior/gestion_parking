@extends('layouts.master')

    <div class="row">

        <div class="col-lg-11">

            <h2>CRUD LARAVEL</h2>

        </div>

        <div class="col-lg-1">
            <a class="btn btn-success" href="{{ url('type_vehicule/create') }}">Ajouter</a>
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
            $type_vehicule = App\Models\Type_Vehicule::all();
        @endphp

        @foreach ($type_vehicule as $index => $type_vehicule)

            <tr>
                <td>{{ $index }}</td>
                <td>{{ $type_vehicule->code }}</td>
                <td>{{ $type_vehicule->libelle }}</td>
                
                <td>
                    <form action="{{ url('type_vehicule/'. $type_vehicule->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <a class="btn btn-info" href="{{ url('type_vehicule/'. $type_vehicule->id) }}">Voir</a>
                        <a class="btn btn-primary" href="{{ url('type_vehicule/'. $type_vehicule->id .'/edit') }}">Modifier</a>

                        <button type="submit" class="btn btn-danger">Supprimer</button>

                    </form>

                </td>

            </tr>

        @endforeach
    </table>


