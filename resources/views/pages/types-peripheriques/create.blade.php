@extends('layouts.app')

@section('title', 'Gestion des périphériques')
@section('voidgrubs')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('types-peripheriques.index') }}">Type peripherique</a></li>
    <li class="breadcrumb-item active" aria-current="page">Creation de type peripherique</li>
  </ol>
</nav>
@endsection

@section('content')
<div class="card">
{{--
    <div class="card-header">

        <h3>Créer un nouveau type de périphérique</h3>

    </div> --}}

    <div class="card-body">

        <form action="{{ route('types-peripheriques.store') }}" method="POST">

            @csrf

              <div class="mt-3 col-12">

                <label for="libelle_type" class="form-label">Libellé du type</label>
                <input type="text" name="libelle_type" class="form-control" id="libelle_type" required>

            </div>


            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Créer</button>
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Retour</a>
            </div>

        </form>


    </div>
</div>
@endsection
