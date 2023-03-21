@extends('layouts.master')


@section('content')

    <h1>LARAVEL CRUD</h1>


    <table class="table table-bordered">

        <tr>
            <th>CODE:</th>
            <td>{{ $abonnement->code }}</td>
        </tr>
        
        <tr>
            <th>DATE ABONNEMENT:</th>
            <td>{{ $abonnement->date_abonnement }}</td>
        </tr>


        <tr>

            <th>LIBELLE:</th>
            <td>{{ $abonnement->libelle }}</td>

        </tr>

    </table>

@endsection