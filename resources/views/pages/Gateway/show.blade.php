@extends('layouts.master')


@section('content')

    <h1>LARAVEL CRUD</h1>


    <table class="table table-bordered">

        <tr>
            <th>CODE:</th>
            <td>{{ $gateway->code }}</td>
        </tr>

        <tr>

            <th>LIBELLE:</th>
            <td>{{ $gateway->libelle }}</td>

        </tr>

        <tr>

            <th>HOST:</th>
            <td>{{ $gateway->host }}</td>
        </tr>
        <tr>
            <th>MOT DE PASSE:</th>
            <td>{{ $gateway->mot_passe }}</td>

        </tr>

        <tr>
            <th>PARKING:</th>
            <td>{{ $gateway->parking_id }}</td>

        </tr>

    </table>

@endsection