@extends('layouts.master')


@section('content')

    <h1>LARAVEL CRUD</h1>


    <table class="table table-bordered">

        <tr>
            <th>CODE:</th>
            <td>{{ $formule->code }}</td>
        </tr>

        <tr>

            <th>LIBELLE:</th>
            <td>{{ $formule->libelle }}</td>

        </tr>

    </table>

@endsection