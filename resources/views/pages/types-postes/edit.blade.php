@extends('layouts.app')

@section('title', 'Gestion des postes de travail')
@section('module', 'Editer type de poste')

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
