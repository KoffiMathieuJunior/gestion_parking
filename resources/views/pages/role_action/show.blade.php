@extends('layouts.master')


@section('content')

    <h1>LARAVEL CRUD</h1>


    <table class="table table-bordered">

        <tr>
            <th>ROLE:</th>
            <td>{{ $role_action->role_id }}</td>
        </tr>

        <tr>
            <th>COULEUR:</th>
            <td>{{ $role_action->action_id }}</td>
        </tr>

    </table>

@endsection