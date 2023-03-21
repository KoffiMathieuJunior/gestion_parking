@extends('layouts.master')


@section('content')

    <h1>LARAVEL CRUD</h1>


    <table class="table table-bordered">

        <tr>
            <th>CODE:</th>
            <td>{{ $type_vehicule->code }}</td>
        </tr>

        <tr>

            <th>LIBELLE:</th>
            <td>{{ $type_vehicule->libelle }}</td>

        </tr>

    </table>

@endsection