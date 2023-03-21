@extends('layouts.master')


@section('content')

    <h1>LARAVEL CRUD</h1>


    <table class="table table-bordered">

        <tr>
            <th>LIBELLE:</th>
            <td>{{ $role->libelle }}</td>
        </tr>

        <tr>
            <th>CODE:</th>
            <td>{{ $role->code }}</td>
        </tr>

        <tr>
            <th>USER:</th>
            <td>{{ $role->user_id }}</td>
        </tr>

       
    </table>

@endsection