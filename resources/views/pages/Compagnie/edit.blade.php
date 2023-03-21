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

    <form method="post" action="{{ url('compagnie/'. $compagnie->id) }}" >
        @method('PATCH')
        @csrf


        <div class="form-group mb-3">

            <label for="libelle">LIBELLE:</label>
            <input type="text" class="form-control" id="libelle" placeholder="Entrer" name="libelle" value="{{ $compagnie->libelle }}">

        </div>
        
        <div class="form-group mb-3">

            <label for="contact">CONTACT:</label>
            <input type="text" class="form-control" id="contact" placeholder="Entrer " name="contact" value="{{ $compagnie->contact }}">

        </div>


        <div class="form-group mb-3">

            <label for="email">EMAIL:</label>
            <input type="text" class="form-control" id="email" placeholder="Entrer" name="email" value="{{ $compagnie->email }}">

        </div>

      

        <button type="submit" class="btn btn-primary">Enregistrer</button>

    </form>

@endsection