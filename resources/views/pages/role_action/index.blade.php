@extends('layouts.master')

    <div class="row">

        <div class="col-lg-11">

            <h2>CRUD LARAVEL</h2>

        </div>

        <div class="col-lg-1">
            <a class="btn btn-success" href="{{ url('role_action/create') }}">Ajouter</a>
        </div>

    </div>

    <table class="table table-bordered">

        <tr>

            <th>ID</th>
            <th>ROLE</th>
            <th>ACTION</th>
            <th>OPTIONS</th>

        </tr>
              
        @php
            $role_action = App\Models\Role_Action::all();
        @endphp

        @foreach ($role_action as $index => $role_action)

            <tr>
                <td>{{ $index }}</td>
                <td>{{ $role_action->role_id }}</td>
                <td>{{ $role_action->action_id }}</td>
                
                <td>

                    <form action="{{ url('role_action/'. $role_action->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <a class="btn btn-info" href="{{ url('role_action/'. $role_action->id) }}">Voir</a>
                        <a class="btn btn-primary" href="{{ url('role_action/'. $role_action->id .'/edit') }}">Modifier</a>

                        <button type="submit" class="btn btn-danger">Supprimer</button>

                </td>

            </tr>

        @endforeach
    </table>


