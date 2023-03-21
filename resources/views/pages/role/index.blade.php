@extends('layouts.master')

    <div class="row">

        <div class="col-lg-11">

            <h2>CRUD LARAVEL</h2>

        </div>

        <div class="col-lg-1">
            <a class="btn btn-success" href="{{ url('role/create') }}">Ajouter</a>
        </div>

    </div>

    <table class="table table-bordered">

        <tr>

            <th>ID</th>
            <th>LIBELLE</th>
            <th>CODE</th>
            <th>USER</th>
            <th>ACTIONS</th>

        </tr>
              
        @php
            $role = App\Models\Role::all();
        @endphp

        @foreach ($role as $index => $role)

            <tr>
                <td>{{ $index }}</td>
                <td>{{ $role->libelle }}</td>
                <td>{{ $role->code }}</td>
                <td>{{ $role->user_id }}</td>
                <td>

                    <form action="{{ url('role/'. $role->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <a class="btn btn-info" href="{{ url('role/'. $role->id) }}">Voir</a>
                        <a class="btn btn-primary" href="{{ url('role/'. $role->id .'/edit') }}">Modifier</a>

                        <button type="submit" class="btn btn-danger">Supprimer</button>

                    </form>
                </td>

            </tr>

        @endforeach
    </table>


