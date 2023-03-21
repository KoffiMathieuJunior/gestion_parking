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

    <form method="post" action="{{ url('gateway/'. $gateway->id) }}" >
        @method('PATCH')
        @csrf


        <div class="form-group mb-3">

            <label for="code">CODE:</label>
            <input type="text" class="form-control" id="code" placeholder="Entrer un code" name="code" value="{{ $gateway->code }}">

        </div>

        <div class="form-group mb-3">

            <label for="libelle">LIBELLE:</label>
            <input type="text" class="form-control" id="libelle" placeholder="Entrer un libellé" name="libelle" value="{{ $gateway->libelle }}">

        </div>

        <div class="form-group mb-3">

            <label for="host">HOST:</label>
            <input type="text" class="form-control" id="host" placeholder="Entrer host" name="host" value="{{ $gateway->host }}">

        </div>

        <div class="form-group mb-3">

            <label for="mot_passe">HOST:</label>
            <input type="text" class="form-control" id="mot_passe" placeholder="Entrer le mot de passe" name="mot_passe" value="{{ $gateway->mot_passe }}">

        </div>

        <div class="form-group mb-3">

            <label for="parking_id">HOST:</label>
            <input type="text" class="form-control" id="parking_id" placeholder="Entrer " name="parking_id" value="{{ $gateway->parking_id }}">

        </div>

        

      

        <button type="submit" class="btn btn-primary">Enregistrer</button>

    </form>

@endsection