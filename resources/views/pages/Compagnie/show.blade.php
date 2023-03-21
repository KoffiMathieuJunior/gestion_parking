@extends('layouts.master')


@section('content')

    <h1>LARAVEL CRUD</h1>


    <table class="table table-bordered">


        <tr>

            <th>LIBELLE:</th>
            <td>{{ $compagnie->libelle }}</td>

        </tr>

        <tr>
            <th>CONTACT:</th>
            <td>{{ $compagnie->contact }}</td>
        </tr>

        <tr>
            <th>EMAIL:</th>
            <td>{{ $compagnie->email }}</td>
        </tr>

    </table>

@endsection