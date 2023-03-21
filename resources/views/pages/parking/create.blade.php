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

    <form action="{{ url('parking') }}" method="POST">
        @csrf

        <div class="form-group mb-3">

            <label for="libelle">LIBELLE:</label>
            <input type="text" class="form-control" id="libelle" placeholder="libelle" name="libelle">

        </div>

        <div class="form-group mb-3">
            <label for="latitude">LATITUDE :</label>
            <input type="text" class="form-control" id="latitude" placeholder="latitude" name="latitude">
        </div>

        <div class="form-group mb-3">
            <label for="longitude">LONGITUDE:</label>
            <input type="text" class="form-control" id="longitude" placeholder="longitude" name="longitude">
        </div>

        <div class="form-group mb-3">
            <label for="adresse">ADRESSE:</label>
            <input type="text" class="form-control" id="adresse" placeholder="Entrez une adresse" name="adresse">
        </div>

        <div class="form-group mb-3">
            <label for="heure_ouverture">HEURE OUVERTURE:</label>
            <input type="text" class="form-control" id="heure_ouverture" placeholder="heure_ouverture" name="heure_ouverture">
        </div>

        <div class="form-group mb-3">
            <label for="heure_fermeture">HEURE FERMETURE :</label>
            <input type="text" class="form-control" id="heure_fermeture" placeholder="heure_fermeture" name="heure_fermeture">
        </div>

        <div class="form-group mb-3">

            <label for="compagnie_id">COMPAGNIE:</label>
            {{-- <select type="text" class="form-control" id="compagnie_id" placeholder="compagnie_id" name="compagnie_id"> --}}

                <select id="compagnie_id" name="compagnie_id" class="form-control @error('compagnie_id') is-invalid @enderror"
                name="compagnie_id" value="{{ old('compagnie_id') }}" required autocomplete="compagnie_id">
                <option value="">Selectionner la compagnie</option>
                @foreach($compagnie as $item)
                    <option value="{{$item->id}}">{{$item->libelle}}</option>
                @endforeach
            </select>

        </div>

        <button type="submit" class="btn btn-primary">Enregister</button>

    </form>

@endsection