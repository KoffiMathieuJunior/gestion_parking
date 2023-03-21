@extends('layouts.master')

    <div class="row">

        <div class="col-lg-11">

            <h2>CRUD LARAVEL</h2>

        </div>

        <div class="col-lg-1">
            <a class="btn btn-success" href="{{ url('type_user/create') }}">Ajouter</a>
        </div>

    </div>

    <table class="table table-bordered">

        <tr>

            <th>ID</th>
            <th>CODE</th>
            <th>NOM</th>
            <th>PRENOMS</th>
            <th>ACTIONS</th>

        </tr>
              
        @php
            $type_user = App\Models\Type_User::all();
        @endphp

        @foreach ($type_user as $index => $type_user)

            <tr>
                <td>{{ $index }}</td>
                <td>{{ $type_user->code }}</td>
                <td>{{ $type_user->nom }}</td>
                <td>{{ $type_user->prenoms }}</td>
                
                <td>
                    <form action="{{ url('type_user/'. $type_user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <a class="btn btn-info" href="{{ url('type_user/'. $type_user->id) }}">Voir</a>
                        <a class="btn btn-primary" href="{{ url('type_user/'. $type_user->id .'/edit') }}">Modifier</a>

                        <button type="submit" class="btn btn-danger">Supprimer</button>

                    </form>

                </td>

            </tr>

        @endforeach
    </table>


