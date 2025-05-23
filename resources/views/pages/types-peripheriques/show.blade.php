@extends('layouts.app')

@section('title', 'Gestion des Périphériques')
@section('voidgrubs')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('types-peripheriques.index') }}">Type peripherique</a></li>
    <li class="breadcrumb-item active" aria-current="page">Détails de type peripherique</li>
  </ol>
</nav>
@endsection

@section('content')

<div class="card">
    {{-- <div class="card-header">
        <h3>Détails de l'utilisateur</h3>
    </div> --}}
    <div class="card-body">
        <form>
            <div class="mt-3 row">
                <div class="mt-3 col-12">
                    <div class="form-group">
                        <label for="libelleType" class="form-label">Type de périphérique </label>
                        <input type="text" class="form-control" id="libelleType" readonly value="{{ $types->libelle_type}}" disabled>
                    </div>
                </div>
            </div>
        </form>
        <div class="mt-3 d-flex justify-content-start">
            <a href="{{ route('types-peripheriques.index') }}" class="btn btn-secondary">Retour à la liste</a>
        </div>
    </div>
</div>




@endsection
