@extends('layouts.app')
@section('title', 'Détails du poste de travail')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Détails du poste de travail</h5>
        <a href="{{ route('poste_travail.edit', $poste->id) }}" class="btn btn-primary">Modifier</a>
    </div>
    <div class="card-body">
    <div class="row">
        <div class="col-6 mb-3">
            <label class="fw-bold">N° de série</label>
            <p>{{ $poste->num_serie_poste_travail }}</p>
        </div>

        <div class="col-6 mb-3">
            <label class="fw-bold">N° d'inventaire</label>
            <p>{{ $poste->num_inventaire_poste_travail }}</p>
        </div>

        <div class="col-6 mb-3">
            <label class="fw-bold">Nom poste de travail</label>
            <p>{{ $poste->nom_poste_travail }}</p>
        </div>

        <div class="col-6 mb-3">
            <label class="fw-bold">Designation</label>
            <p>{{ $poste->designation_poste_travail ?? 'Non spécifié' }}</p>
        </div>

        <div class="col-6 mb-3">
            <label class="fw-bold">Type d'ordinateur</label>
            <p>{{ ucfirst($poste->type_poste_travail) }}</p>
        </div>

        <div class="col-6 mb-3">
            <label class="fw-bold">État de la machine</label>
            <p>{{ $poste->etat_poste_travail }}</p>
        </div>

        <div class="col-6 mb-3">
            <label class="fw-bold">Date d'acquisition</label>
            <p>{{ \Carbon\Carbon::parse($poste->date_acq)->format('d/m/Y') }}</p>
        </div>
    </div>

    <div class="mt-4">
        <h6 class="fw-bold">Périphériques associés</h6>
        @if($poste->peripheriques->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>N° Série</th>
                            <th>Type</th>
                            <th>État</th>
                            <th>Date d'acquisition</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($poste->peripheriques as $peripherique)
                            <tr>
                                <td>{{ $peripherique->num_serie }}</td>
                                <td>{{ $peripherique->type }}</td>
                                <td>{{ $peripherique->etat }}</td>
                                <td>{{ \Carbon\Carbon::parse($peripherique->date_acq)->format('d/m/Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-muted">Aucun périphérique associé</p>
        @endif
    </div>

    <div class="mt-4">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Retour</a>
    </div>
</div>
</div>
@endsection
