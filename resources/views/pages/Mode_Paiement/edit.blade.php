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

    <form method="post" action="{{ url('mode_paiement/'. $mode_paiement->id) }}" >
        @method('PATCH')
        @csrf


        <div class="form-group mb-3">

            <label for="code">CODE:</label>
            <input type="text" class="form-control" id="code" placeholder="Entrer un code" name="code" value="{{ $mode_paiement->code }}">

        </div>

        <div class="form-group mb-3">

            <label for="libelle">LIBELLE:</label>
            <input type="text" class="form-control" id="libelle" placeholder="Entrer un libellé" name="libelle" value="{{ $mode_paiement->libelle }}">

        </div>

      

        <button type="submit" class="btn btn-primary">Enregistrer</button>

    </form>

@endsection