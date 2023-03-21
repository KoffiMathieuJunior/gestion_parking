@extends('layouts.master')

    <div class="row">

        <div class="col-lg-11">

            <h2>CRUD LARAVEL</h2>

        </div>

        <div class="col-lg-1">
            <a class="btn btn-success" href="{{ url('action/create') }}">Ajouter</a>
        </div>

    </div>

    <table class="table table-bordered">

        <tr>

            <th>ID</th>
            <th>CODE</th>
            <th>LIBELLE</th>
            <th>PARENT</th>
            <th>ACTIONS</th>

        </tr>
              
        @php
            $action = App\Models\Action::all();
        @endphp

        @foreach ($action as $index => $action)

            <tr>
                <td>{{ $index }}</td>
                <td>{{ $action->code }}</td>
                <td>{{ $action->libelle }}</td>
                <td>{{ $action->parent_id }}</td>
                <td>
                    <form action="{{ url('action/'. $action->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <a class="btn btn-info" href="{{ url('action/'. $action->id) }}">Voir</a>
                        <a class="btn btn-primary" href="{{ url('action/'. $action->id .'/edit') }}">Modifier</a>

                        <button type="submit" class="btn btn-danger">Supprimer</button>

                    </form>

                </td>

            </tr>

        @endforeach
    </table>


