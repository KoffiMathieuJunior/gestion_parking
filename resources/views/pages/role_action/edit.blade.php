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

    <form method="post" action="{{ url('vehicule/'. $vehicule->id) }}" >
        @method('PATCH')
        @csrf


        <div class="form-group mb-3">

            <label for="role">ROLE:</label>
            <input type="text" class="form-control" id="role" placeholder="Entrer" name="role" value="{{ $role_action->role }}">

        </div>

        <div class="form-group mb-3">

            <label for="action">COULEUR:</label>
            <input type="text" class="form-control" id="action" placeholder="Entrer" name="action" value="{{ $role_action->action }}">

        </div>


       

      
       

        <button type="submit" class="btn btn-primary">Enregistrer</button>

    </form>

@endsection