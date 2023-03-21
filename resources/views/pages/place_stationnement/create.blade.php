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

    <form action="{{ url('place_stationnement') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label for="libelle">LIBELLE :</label>
            <input type="text" class="form-control" id="libelle" placeholder="Entrez libelle" name="libelle">
        </div>

        <div class="form-group mb-3">

            <label for="etat">ETAT:</label>
            <input type="text" class="form-control" id="etat" placeholder="etat" name="etat">

        </div>

        <div class="form-group mb-3">
        <select id="type_vehicule_id" name="type_vehicule_id" class="form-control @error('type_vehicule_id') is-invalid @enderror"
         name="type_vehicule_id" value="{{ old('type_vehicule_id') }}" required autocomplete="type_vehicule_id">
         <option value="">Selectionner type vehicule</option>
        @foreach($data['type_vehicule'] as $item)
         <option value="{{$item->id}}">{{$item->libelle}}</option>
          @endforeach
        </select>

    </div>
        <div class="form-group mb-3">
        <select id="parking_id" name="parking_id" class="form-control @error('parking_id') is-invalid @enderror"
         name="parking_id" value="{{ old('parking_id') }}" required autocomplete="parking_id">
         <option value="">Selectionner parking</option>
        @foreach($data['parking'] as $item)
         <option value="{{$item->id}}">{{$item->libelle}}</option>
          @endforeach
        </select>
        </div>

        <div class="form-group mb-3">
            <select id="capteur_id" name="capteur_id" class="form-control @error('capteur_id') is-invalid @enderror"
             name="capteur_id" value="{{ old('capteur_id') }}" required autocomplete="capteur_id">
             <option value="">Selectionner capteur</option>
            @foreach($data['capteur'] as $item)
             <option value="{{$item->id}}">{{$item->libelle}}</option>
              @endforeach
            </select>
            </div>
        

      <div class="form-group mb-3">
         <button type="submit" class="btn btn-primary">Enregister</button>
      </div>
    </form>

@endsection