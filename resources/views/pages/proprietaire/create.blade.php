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

    <form action="{{ url('proprietaire') }}" method="POST">
        @csrf

        

        <div class="form-group mb-3">

            <label for="libelle">LIBELLE:</label>
            <input type="text" class="form-control" id="libelle" placeholder="libelle" name="libelle">

        </div>

        <div class="form-group mb-3">
            <label for="contact">CONTACT:</label>
            <input type="text" class="form-control" id="contact" placeholder="Entrez un contact" name="contact">
        </div>

        <div class="form-group mb-3">
            <label for="email">EMAIL:</label>
            <input type="text" class="form-control" id="email" placeholder="Entrez un email" name="email">
        </div>
        
        <div class="form-group mb-3">
            <label for="date_inscription">DATE D'INSCRIPTION:</label>
            <input type="text" class="form-control" id="date_inscription" placeholder="Entrez un date_inscription" name="date_inscription">
        </div>

        <div class="form-group mb-3">
            <label for="logo">LOGO:</label>
            <input type="text" class="form-control" id="logo" placeholder="Entrez un logo" name="logo">
        </div>

        <div class="form-group mb-3">

            <label for="type_proprietaire_id">TYPE PROPRIETAIRE:</label>
            {{-- <select type="text" class="form-control" id="type_proprietaire_id" placeholder="type_proprietaire" name="type_proprietaire_id"> --}}

                <select id="type_proprietaire_id" name="type_proprietaire_id" class="form-control @error('type_proprietaire_id') is-invalid @enderror"
                name="type_proprietaire_id" value="{{ old('type_proprietaire_id') }}" required autocomplete="type_proprietaire_id">
                <option value="">SELCTIONNER TYPE PROPRIETAIRE</option>
                @foreach($type_proprietaire as $item)
                    <option value="{{$item->id}}">{{$item->libelle}}</option>
                @endforeach
            </select>

        </div>

        <button type="submit" class="btn btn-primary">Enregister</button>

    </form>

@endsection