@extends('layouts.app')
@section('title', 'Gestion des postes de travail')
@section('module', 'Détails poste de travail')

@section('content')
<div class="card">
    <div class="card-header">
        Détails du périphérique : {{ $postes->nom_poste }}
    </div>

    <div class="card-body">
        <form>
            <div class="row">
                <div class="mt-3 col-6">
                    <label for="num_serie_poste" class="form-label">N° de série</label>
                    <input type="text" name="num_serie_poste" class="form-control" id="num_serie_poste" value="{{ $postes->num_serie_poste }}" disabled>
                </div>

                <div class="col-6 mt-3">
                    <label for="num_inventaire_poste" class="form-label">N° d'inventaire</label>
                    <input type="text" name="num_inventaire_poste" class="form-control" id="num_inventaire_poste" value="{{ $postes->num_inventaire_poste }}" disabled>
                </div>

                <div class="col-6 mt-3">
                    <label for="nom_poste" class="form-label">Nom du périphérique</label>
                    <input type="text" name="nom_poste" class="form-control" id="nom_poste" value="{{ $postes->nom_poste }}" disabled>
                </div>

                <div class="col-6 mt-3">
                    <label for="designation_poste" class="form-label">Désignation</label>
                    <input type="text" name="designation_poste" class="form-control" id="designation_poste" value="{{ $postes->designation_poste }}" disabled>
                </div>

                <div class="col-6 mt-3">
                    <label for="etat_poste" class="form-label">État</label>
                    <select name="etat_poste" class="form-select" disabled>
                        <option value="En panne" {{ $postes->etat_poste == 'En panne' ? 'selected' : '' }}>En panne</option>
                        <option value="En service" {{ $postes->etat_poste == 'En service' ? 'selected' : '' }}>En service</option>
                        <option value="Réformé" {{ $postes->etat_poste == 'Réformé' ? 'selected' : '' }}>Réformé</option>
                        <option value="Non attribué" {{ $postes->etat_poste == 'Non attribué' ? 'selected' : '' }}>Non attribué</option>
                    </select>
                </div>

                <div class="col-6 mt-3">
                    <label for="type_poste" class="form-label">Type</label>
                    <select name="type_poste" class="form-select" disabled>

                    </select>
                </div>

                <div class="col-6 mt-3">
                    <label for="agent_id" class="form-label">Propriétaire</label>
                    <select name="agent_id" class="js-example-basic-single form-control" disabled>
                        <option value="">-- Choisir --</option>
                        @foreach($agents as $agent)
                            <option value="{{ $agent->id }}" {{ $postes->agent_id == $agent->id ? 'selected' : '' }}>{{ $agent->nom_agent }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-6 mt-3">
                    <label for="poste_id" class="form-label">Poste</label>
                    <select name="poste_id" class="js-example-basic-single form-control" disabled>
                        <option value="">-- Choisir --</option>
                        @foreach($postes as $poste)
                            <option value="{{ $poste->id }}" {{ $postes->poste_id == $poste->id ? 'selected' : '' }}>{{ $poste->nom_poste }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-6 mt-3">
                    <label for="date_acq" class="form-label">Date d'acquisition</label>
                    <input type="date" name="date_acq" class="form-control" id="date_acq" value="{{ \Carbon\Carbon::parse($postes->date_acq)->format('Y-m-d') }}" disabled>
                </div>

                <div class="mt-3 d-flex justify-content-between">
                    <a href="{{ route('postes.index') }}" class="btn btn-secondary">Retour</a>
                </div>
            </div>
        </form>

    </div>
</div>
@endsection

@section('select')
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>
@endsection
