@extends('layouts.master')


@section('content')

    <h1>LARAVEL CRUD</h1>


    <table class="table table-bordered">

        <tr>
            <th>CODE:</th>
            <td>{{ $type_user->code }}</td>
        </tr>

        <tr>

            <th>NOM:</th>
            <td>{{ $type_user->nom }}</td>

        </tr>

        <tr>

            <th>PRENOMS:</th>
            <td>{{ $type_user->prenoms }}</td>

        </tr>

    </table>

@endsection