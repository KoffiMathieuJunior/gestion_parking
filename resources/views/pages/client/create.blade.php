@extends('layouts.master')


@section('content')

    <h1>AJOUTER UN CLIENT</h1>


    @if ($errors->any())

        <div class="alert alert-danger">

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>

    @endif

    <form action="{{ url('client') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label for="nom">NOM :</label>
            <input type="text" class="form-control" id="nom" placeholder="Entrez un nom" name="nom">
        </div>

        <div class="form-group mb-3">

            <label for="prenoms">PRENOMS:</label>
            <input type="text" class="form-control" id="prenoms" placeholder="prenoms" name="prenoms">

        </div>

        <div class="form-group mb-3">

            <label for="code">CODE:</label>
            <input type="text" class="form-control" id="code" placeholder="code" name="code">

        </div>

        <div class="form-group mb-3">

            <label for="phone">PHONE:</label>
            <input type="text" class="form-control" id="phone" placeholder="phone" name="phone">

        </div>

        <div class="form-group mb-3">

            <label for="email">EMAIL:</label>
            <input type="text" class="form-control" id="email" placeholder="email" name="email">

        </div>

        <div class="form-group mb-3">

            <label for="mot_passe">MOT DE PASSE:</label>
            <input type="text" class="form-control" id="mot_passe" placeholder="mot_passe" name="mot_passe">

        </div>

        <div class="form-group mb-3">

            
                <select id="abonnement_id" name="abonnement_id" class="form-control @error('abonnement_id') is-invalid @enderror"
                 name="client_id" value="{{ old('abonnement_id') }}" required autocomplete="abonnement_id">
                 <option value="">Selectionner abonnement</option>
                @foreach($data['abonnement'] as $item)
                 <option value="{{$item->id}}">{{$item->libelle}}</option>
                  @endforeach
                </select>
                

        </div>
        
        <button type="submit" class="btn btn-primary">Enregister</button>

    </form>

@endsection