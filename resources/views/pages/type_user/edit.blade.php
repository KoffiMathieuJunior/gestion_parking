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

    <form method="post" action="{{ url('type_user/'. $type_user->id) }}" >
        @method('PATCH')
        @csrf


        <div class="form-group mb-3">

            <label for="code">CODE:</label>
            <input type="text" class="form-control" id="code" placeholder="Entrer un code" name="code" value="{{ $type_user->code }}">

        </div>

        <div class="form-group mb-3">

            <label for="nom">NOM:</label>
            <input type="text" class="form-control" id="nom" placeholder="Entrer un nom" name="nom" value="{{ $type_user->nom }}">

        </div>

        <div class="form-group mb-3">

            <label for="prenoms">PRENOMS:</label>
            <input type="text" class="form-control" id="prenoms" placeholder="Entrer un prenoms" name="prenoms" value="{{ $type_user->prenoms }}">

        </div>

      

        <button type="submit" class="btn btn-primary">Enregistrer</button>

    </form>

@endsection