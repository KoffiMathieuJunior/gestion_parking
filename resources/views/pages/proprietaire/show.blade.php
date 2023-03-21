@extends('layouts.master')


@section('content')

    <h1>LARAVEL CRUD</h1>


    <table class="table table-bordered">

        <tr>
            <th>CODE:</th>
            <td>{{ $proprietaire->libelle }}</td>
        </tr>

        <tr>

            <th>LIBELLE:</th>
            <td>{{ $proprietaire->contact }}</td>

        </tr>

        <tr>

            <th>EMAIL:</th>
            <td>{{ $proprietaire->email }}</td>

        </tr>

        <tr>

            <th>DATE INSCRIPTION:</th>
            <td>{{ $proprietaire->date_inscription }}</td>

        </tr>
        <tr>

            <th>LOGO:</th>
            <td>{{ $proprietaire->logo }}</td>

        </tr>

        <tr>

            <th>TYPE PROPRIETAIRE:</th>
            <td>{{ $proprietaire->type_proprietaire_id }}</td>

        </tr>

    </table>

@endsection