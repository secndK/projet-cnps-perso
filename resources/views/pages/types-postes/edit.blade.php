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
                    <label for="libelleType" class="form-label">Type de poste</label>
                    <input type="text" name="libelle_type" class="form-control @error('libelle_type') is-invalid @enderror"
                           id="libelleType" value="{{ old('libelle_type', $types->libelle_type) }}" required>
                    @error('libelle_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-3 d-flex justify-content-between">
                    <a href="{{ route('types-postes.index') }}" class="btn btn-secondary">Retour</a>
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
