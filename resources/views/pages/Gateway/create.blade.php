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

    <form action="{{ url('gateway') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label for="code">CODE :</label>
            <input type="text" class="form-control" id="code" placeholder="Entrez un code" name="code">
        </div>

        <div class="form-group mb-3">

            <label for="libelle">LIBELLE:</label>
            <input type="text" class="form-control" id="libelle" placeholder="libelle" name="libelle">

        </div>
        
        <div class="form-group mb-3">
            <label for="host">HOST:</label>
            <input type="text" class="form-control" id="host" placeholder="Entrez host" name="host">
        </div>
        <div class="form-group mb-3">
            <label for="mot_passe">MOT DE PASSE:</label>
            <input type="text" class="form-control" id="mot_passe" placeholder="Entrez mot de passe" name="mot_passe">
        </div>
        <div class="form-group mb-3">

            <label for="parking_id">ABONNEMENT:</label>
            {{-- <select type="text" class="form-control" id="parking_id" placeholder="parking" name="parking_id"> --}}

                <select id="parking_id" name="parking_id" class="form-control @error('parking_id') is-invalid @enderror"
                name="parking_id" value="{{ old('parking_id') }}" required autocomplete="parking_id">
                <option value="">Selectionner un Abonnement</option>
                @foreach($parking as $item)
                    <option value="{{$item->id}}">{{$item->libelle}}</option>
                @endforeach
            </select>

        </div>
        


        <button type="submit" class="btn btn-primary">Enregister</button>

    </form>

@endsection