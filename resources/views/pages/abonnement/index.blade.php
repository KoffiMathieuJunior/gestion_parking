@extends('layouts.master')

    <div class="row">

        <div class="col-lg-11">

            <h2>CRUD LARAVEL</h2>

        </div>

        <div class="col-lg-1">
            <a class="btn btn-success" href="{{ url('abonnement/create') }}">Ajouter</a>
        </div>

    </div>

    <table class="table table-bordered">

        <tr>

            <th>ID</th>
            <th>CODE</th>
            <th>DATE D'ABONNEMENT</th>
            <th>LIBELLE</th>
            <th>ACTIONS</th>

        </tr>
              
        @php
            $abonnement = App\Models\Abonnement::all();
        @endphp

        @foreach ($abonnement as $index => $abonnement)

            <tr>
                <td>{{ $index }}</td>
                <td>{{ $abonnement->code }}</td>
                <td>{{ $abonnement->date_abonnement }}</td>
                <td>{{ $abonnement->libelle }}</td>
                
                <td>

                    <form action="{{ url('abonnement/'. $abonnement->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <a class="btn btn-info" href="{{ url('abonnement/'. $abonnement->id) }}">Voir</a>
                        <a class="btn btn-primary" href="{{ url('abonnement/'. $abonnement->id .'/edit') }}">Modifier</a>

                        <button type="submit" class="btn btn-danger">Supprimer</button>

                    </form>

                </td>

            </tr>

        @endforeach
    </table>


