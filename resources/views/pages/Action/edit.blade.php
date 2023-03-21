@extends('layouts.master')


@section('content')


    <h1>MODIFIER L'ACTION</h1>


    @if ($errors->any())

        <div class="alert alert-danger">

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>

    @endif

    <form method="post" action="{{ url('action/'. $action->id) }}" >
        @method('PATCH')
        @csrf


        <div class="form-group mb-3">

            <label for="code">CODE:</label>
            <input type="text" class="form-control" id="code" placeholder="Entrer un code" name="code" value="{{ $action->code }}">

        </div>
        


        <div class="form-group mb-3">

            <label for="libelle">LIBELLE:</label>
            <input type="text" class="form-control" id="libelle" placeholder="Entrer un libellé" name="libelle" value="{{ $action->libelle }}">

        </div>
        
        <div class="form-group mb-3">

            <label for="parent_id">PARENT:</label>
            <input type="text" class="form-control" id="parent_id" placeholder="Entrer" name="parent_id" value="{{ $action->parent_id }}">

        </div>


      

        <button type="submit" class="btn btn-primary">Enregistrer</button>

    </form>

@endsection