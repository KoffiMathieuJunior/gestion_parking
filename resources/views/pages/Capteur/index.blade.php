@extends('layouts.master')

    <div class="row">

        <div class="col-lg-11">

            <h2>CRUD LARAVEL</h2>

        </div>

        <div class="col-lg-1">
            <a class="btn btn-success" href="{{ url('capteur/create') }}">Ajouter</a>
        </div>

    </div>

    <table class="table table-bordered">

        <tr>

            <th>ID</th>
            <th>NOM</th>
            <th>PRENOMS</th>
            <th>CODE</th>
            <th>PHONE</th>
            <th>EMAIL</th>
            <th>MOT DE PASSE</th>
            <th>ABONNEMENT</th>
            <th>ACTIONS</th>

        </tr>
              
        @php
            $capteur = App\Models\Capteur::all();
        @endphp

        @foreach ($capteur as $index => $capteur)

            <tr>
                <td>{{ $index }}</td>
                <td>{{ $capteur->libelle }}</td>
                <td>{{ $capteur->etat }}</td>
                <td>{{ $capteur->statut_id }}</td>
                <td>{{ $capteur->gateway_id }}</td>
                <td>

                    <form action="{{ url('capteur/'. $capteur->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <a class="btn btn-info" href="{{ url('capteur/'. $capteur->id) }}">Voir</a>
                        <a class="btn btn-primary" href="{{ url('capteur/'. $capteur->id .'/edit') }}">Modifier</a>

                        <button type="submit" class="btn btn-danger">Supprimer</button>

                    </form>
                </td>

            </tr>

        @endforeach
    </table>


