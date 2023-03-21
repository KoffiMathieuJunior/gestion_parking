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

    <form action="{{ url('role') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label for="libelle">LIBELLE :</label>
            <input type="text" class="form-control" id="libelle" placeholder="Entrez libelle" name="libelle">
        </div>

        <div class="form-group mb-3">

            <label for="code">CODE:</label>
            <input type="text" class="form-control" id="code" placeholder="code" name="code">

        </div>

    </div>
    <div class="form-group mb-3">
        <select id="user_id" name="user_id" class="form-control @error('user_id') is-invalid @enderror"
         name="user_id" value="{{ old('user_id') }}" required autocomplete="user_id">
         <option value="">Selectionner user</option>
        @foreach($data['user'] as $item)
         <option value="{{$item->id}}">{{$item->nom}}</option>
          @endforeach
        </select>
    </div>
        

      <div class="form-group mb-3">
         <button type="submit" class="btn btn-primary">Enregister</button>
      </div>
    </form>

@endsection