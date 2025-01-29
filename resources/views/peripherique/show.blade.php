@extends('layouts.app')

@section('title', 'Gestion des Périphériques')

@section('content')

<br>
<br>

<div class="card">
    <div class="card-header bg-light">
        <h5 class="mb-0">Détails du Périphérique</h5>
    </div>

    <div class="card-body">
        <div class="row">
            <!-- Numéro de série -->
            <div class="mt-3 col-6">
                <div class="form-group">
                    <label for="NumSeriePeripherique" class="form-label">N° de série</label>
                    <input type="text" class="form-control" id="NumSeriePeripherique" value="{{ $peripheriques->num_serie_peripherique }}" disabled>
                </div>
            </div>

            <!-- Numéro d'inventaire -->
            <div class="mt-3 col-6">
                <div class="form-group">
                    <label for="NumInventairePeripherique" class="form-label">N° d'inventaire</label>
                    <input type="text" class="form-control" id="NumInventairePeripherique" value="{{ $peripheriques->num_inventaire_peripherique }}" disabled>
                </div>
            </div>

            <!-- Nom du périphérique -->
            <div class="mt-3 col-6">
                <div class="form-group">
                    <label for="NomPeripherique" class="form-label">Nom du périphérique</label>
                    <input type="text" class="form-control" id="NomPeripherique" value="{{ $peripheriques->nom_peripherique }}" disabled>
                </div>
            </div>

            <!-- Désignation -->
            <div class="mt-3 col-6">
                <div class="form-group">
                    <label for="DesignationPeripherique" class="form-label">Désignation</label>
                    <input type="text" class="form-control" id="DesignationPeripherique" value="{{ $peripheriques->designation_peripherique }}" disabled>
                </div>
            </div>

            <!-- Type de périphérique -->
            <div class="mt-3 col-6">
                <div class="form-group">
                    <label for="TypePeripherique" class="form-label">Type</label>
                    <input type="text" class="form-control" id="TypePeripherique" value="{{ $peripheriques->type_peripherique }}" disabled>
                </div>
            </div>

            <!-- État du périphérique -->
            <div class="mt-3 col-6">
                <div class="form-group">
                    <label for="EtatPeripherique" class="form-label">État</label>
                    <input type="text" class="form-control" id="EtatPeripherique" value="{{ $peripheriques->etat_peripherique }}" disabled>
                </div>
            </div>

            <!-- Date d'acquisition -->
            <div class="mt-3 col-6">
                <div class="form-group">
                    <label for="DateAcq" class="form-label">Date d'acquisition</label>
                    <input type="date" class="form-control" id="DateAcq"
                    value="{{ $peripheriques->date_acq ? date('Y-m-d', strtotime($peripheriques->date_acq)) : '' }}"
                    disabled>
                </div>
            </div>
        </div>

        <!-- Bouton retour -->
        <div class="mt-4 d-flex justify-content-end">
            <a href="{{ route('peripherique.index') }}" class="btn btn-secondary">Retour</a>
        </div>
    </div>
</div>

@endsection
