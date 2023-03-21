@extends('layouts.master')


@section('content')


    <h1>MODIFIER</h1>


    @if ($errors->any())

        <div class="alert alert-danger">

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>

    @endif

    <form method="post" action="{{ url('role/'. $role->id) }}" >
        @method('PATCH')
        @csrf
        <div class="form-group mb-3">

            <label for="libelle">LIBELLE:</label>
            <input type="text" class="form-control" id="libelle" placeholder="Entrer un libellé" name="libelle" value="{{ $role->libelle }}">

        </div>

        <div class="form-group mb-3">

            <label for="code">CODE:</label>
            <input type="text" class="form-control" id="code" placeholder="Entrer un code" name="code" value="{{ $role->code }}">

        </div>

        <div class="form-group mb-3">

            <label for="user_id">USER:</label>
            <input type="text" class="form-control" id="user_id" placeholder="user" name="user_id" value="{{ $role->user_id }}">

        </div>

      

        <button type="submit" class="btn btn-primary">Enregistrer</button>

    </form>

@endsection