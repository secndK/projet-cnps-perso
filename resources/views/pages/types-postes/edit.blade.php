@extends('layouts.app')

@section('title', 'Gestion des postes de travail')
@section('voidgrubs')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('types-postes.index') }}">Type poste</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edition de type poste</li>
  </ol>
</nav>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-body">
            <form action="{{ route('types-postes.update', $types->id) }}" method="POST">
                @csrf
                @method('PUT')

            <div class="mb-3 col-12">
                <label for="libelleType" class="form-label">Type de poste </label>
                <input type="text" name="libelle_type" class="form-control" id="libelleType" value="{{ $types->libelle_type}}" required>
            </div>

              <!-- Boutons d'action -->
              <div class="mt-3 d-flex justify-content-between">
                <a href="{{ url()->previous()}}" class="btn btn-secondary">Retour</a>
                <button type="submit" class="btn btn-primary">Mettre à jour</button>

            </div>

            </form>
        </div>
    </div>
</div>

@endsection
