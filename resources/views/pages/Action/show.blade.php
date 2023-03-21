@extends('layouts.master')


@section('content')

    <h1>LARAVEL CRUD</h1>


    <table class="table table-bordered">

        <tr>
            <th>CODE:</th>
            <td>{{ $action->code }}</td>
        </tr>
        
        <tr>
            <th>LIBELLE:</th>
            <td>{{ $action->libelle }}</td>
        </tr>


        <tr>

            <th>PARENT:</th>
            <td>{{ $action->parent_id }}</td>

        </tr>

    </table>

@endsection