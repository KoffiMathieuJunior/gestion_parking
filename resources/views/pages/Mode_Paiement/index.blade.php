@extends('layouts.master')

    <div class="row">

        <div class="col-lg-11">

            <h2>CRUD LARAVEL</h2>

        </div>

        <div class="col-lg-1">
            <a class="btn btn-success" href="{{ url('mode_paiement/create') }}">Ajouter</a>
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
            $mode_paiement = App\Models\Mode_Paiement::all();
        @endphp

        @foreach ($mode_paiement as $index => $mode_paiement)

            <tr>
                <td>{{ $index }}</td>
                <td>{{ $mode_paiement->code }}</td>
                <td>{{ $mode_paiement->libelle }}</td>
                
                <td>

                    <form action="{{ url('mode_paiement/'. $mode_paiement->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <a class="btn btn-info" href="{{ url('mode_paiement/'. $mode_paiement->id) }}">Voir</a>
                        <a class="btn btn-primary" href="{{ url('mode_paiement/'. $mode_paiement->id .'/edit') }}">Modifier</a>

                        <button type="submit" class="btn btn-danger">Supprimer</button>
                </td>

            </tr>

        @endforeach
    </table>


