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
    <form method="post" action="{{ url('proprietaire/'. $proprietaire->id) }}" >
        @method('PATCH')
        @csrf



        <div class="form-group mb-3">

            <label for="libelle">LIBELLE:</label>
            <input type="text" class="form-control" id="libelle" placeholder="Entrer un libellé" name="libelle" value="{{ $proprietaire->libelle }}">

        </div>

        <div class="form-group mb-3">

            <label for="contact">CONTACT:</label>
            <input type="text" class="form-control" id="contact" placeholder="Entrer un contact" name="code" value="{{ $proprietaire->contact }}">

        </div>

        <div class="form-group mb-3">

            <label for="email">EMAIL:</label>
            <input type="text" class="form-control" id="email" placeholder="Entrer un email" name="email" value="{{ $proprietaire->email }}">

        </div>
        
        <div class="form-group mb-3">

            <label for="date_inscription">DATE_INSCRIPTION:</label>
            <input type="text" class="form-control" id="date_inscription" placeholder="Entrer une date" name="date_inscription" value="{{ $proprietaire->date_inscription }}">

        </div>

        <div class="form-group mb-3">

            <label for="logo">LOGO:</label>
            <input type="text" class="form-control" id="logo" placeholder="Entrer une logo" name="logo" value="{{ $proprietaire->logo }}">

        </div>
        <div class="form-group mb-3">

            <label for="type_proprietaire_id">TYPE PROPRIETAIRE:</label>
            <input type="text" class="form-control" id="type_proprietaireid" placeholder="Entrer type proprietaire" name="type_proprietaire_id" value="{{ $proprietaire->type_proprietaire_id }}">

        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>

    </form>

@endsection