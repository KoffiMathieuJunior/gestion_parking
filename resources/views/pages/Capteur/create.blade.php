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

    <form action="{{ url('capteur') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label for="libelle">LIBELLE :</label>
            <input type="text" class="form-control" id="libelle" placeholder="Entrez " name="libelle">
        </div>

        <div class="form-group mb-3">

            <label for="etat">ETAT:</label>
            <input type="text" class="form-control" id="etat" placeholder="etat" name="etat">

        </div>

        <div class="form-group mb-3">
        <select id="statut_id" name="statut_id" class="form-control @error('statut_id') is-invalid @enderror"
         name="statut_id" value="{{ old('statut_id') }}" required autocomplete="statut_id">
         <option value="">Selectionner statut</option>
        @foreach($data['statut'] as $item)
         <option value="{{$item->id}}">{{$item->libelle}}</option>
          @endforeach
        </select>

    </div>
        <div class="form-group mb-3">
        <select id="gateway_id" name="gateway_id" class="form-control @error('gateway_id') is-invalid @enderror"
         name="gateway_id" value="{{ old('gateway_id') }}" required autocomplete="gateway_id">
         <option value="">Selectionner gateway</option>
        @foreach($data['gateway'] as $item)
         <option value="{{$item->id}}">{{$item->libelle}}</option>
          @endforeach
        </select>
        </div>
        

      <div class="form-group mb-3">
         <button type="submit" class="btn btn-primary">Enregister</button>
      </div>
    </form>

@endsection