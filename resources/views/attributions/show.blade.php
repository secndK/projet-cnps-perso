@extends('layouts.app')

@section('title', 'Gestion des accès')
@section('module', 'Attribution des équipements')

@section('content')

<div class="card">
    <div class="card-header bg-light d-flex justify-content-start align-items-center">
        <div>
            <h5>Détails de l'attribution</h5>
        </div>
    </div>

    <div class="card-body">
        <div class="form-group">
            <label><strong>Libellé :</strong></label>
            <p>{{ $attribution->libelle_attribution }}</p>
        </div>
        <div class="form-group">
            <label><strong>Agent :</strong></label>
            <p>{{ $attribution->agent->nom }}</p>
        </div>
        <div class="form-group">
            <label><strong>Postes :</strong></label>
            <ul>
                @foreach ($attribution->postes as $poste)
                    <li>{{ $poste->nom_poste }}</li>
                @endforeach
            </ul>
        </div>
        <div class="form-group">
            <label><strong>Périphériques :</strong></label>
            <ul>
                @foreach ($attribution->peripheriques as $peripherique)
                    <li>{{ $peripherique->nom }}</li>
                @endforeach
            </ul>
        </div>
        <div class="form-group">
            <label><strong>Date Attribution :</strong></label>
            <p>{{ $attribution->date_attribution }}</p>
        </div>
        <div class="form-group">
            <label><strong>Date Retrait :</strong></label>
            <p>{{ $attribution->date_retrait ?? 'N/A' }}</p>
        </div>
        <a href="{{ route('attributions.index') }}" class="btn btn-secondary">Retour</a>
    </div>
</div>

@endsection