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

    <form action="{{ url('role_action') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
        <select id="role_id" name="role_id" class="form-control @error('role_id') is-invalid @enderror"
         name="role_id" value="{{ old('role_id') }}" required autocomplete="role_id">
         <option value="">Selectionner type vehicule</option>
        @foreach($data['role'] as $item)
         <option value="{{$item->id}}">{{$item->libelle}}</option>
          @endforeach
        </select>

    </div>
        <div class="form-group mb-3">
        <select id="action_id" name="action_id" class="form-control @error('action_id') is-invalid @enderror"
         name="action_id" value="{{ old('action_id') }}" required autocomplete="action_id">
         <option value="">Selectionner un client</option>
        @foreach($data['action'] as $item)
         <option value="{{$item->id}}">{{$item->nom}}</option>
          @endforeach
        </select>
        </div>
        

      <div class="form-group mb-3">
         <button type="submit" class="btn btn-primary">Enregister</button>
      </div>
    </form>

@endsection