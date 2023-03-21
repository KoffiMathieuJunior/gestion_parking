@extends('layouts.master')


@section('content')

    <h1>LARAVEL CRUD</h1>


    <table class="table table-bordered">

        <tr>
            <th>CODE:</th>
            <td>{{ $mode_paiement->code }}</td>
        </tr>

        <tr>

            <th>LIBELLE:</th>
            <td>{{ $mode_paiement->libelle }}</td>

        </tr>

    </table>

@endsection