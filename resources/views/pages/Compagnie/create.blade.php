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

    <form action="{{ url('compagnie') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label for="libelle">LIBELLE :</label>
            <input type="text" class="form-control" id="" placeholder="Entrez un libelle" name="libelle">
        </div>

        <div class="form-group mb-3">

            <label for="contact">CONTACT:</label>
            <input type="text" class="form-control" id="contact" placeholder="contact" name="contact">

        </div>

        <div class="form-group mb-3">

            <label for="email">EMAIL:</label>
            <input type="text" class="form-control" id="email" placeholder="email" name="email">

        </div>

        <button type="submit" class="btn btn-primary">Enregister</button>

    </form>

@endsection