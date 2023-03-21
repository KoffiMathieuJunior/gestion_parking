@extends('layouts.master')


@section('content')

    <h1>AJOUTER</h1>


    @if ($errors->any())

        <div class="alert alert-danger">

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>

    @endif

    <form action="{{ url('type_user') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label for="code">CODE :</label>
            <input type="text" class="form-control" id="code" placeholder="Entrez un code" name="code">
        </div>

        <div class="form-group mb-3">

            <label for="nom">NOM:</label>
            <input type="text" class="form-control" id="nom" placeholder="nom" name="nom">

        </div>

        <div class="form-group mb-3">

            <label for="prenoms">PRENOMS:</label>
            <input type="text" class="form-control" id="prenoms" placeholder="prenoms" name="prenoms">

        </div>

        <button type="submit" class="btn btn-primary">Enregister</button>

    </form>

@endsection