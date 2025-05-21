@extends('layouts.app')
@section('title', 'Gestion des postes de travail')
@section('module', 'Détails poste de travail')

@section('content')
<div class="card">
    <div class="card-header">
        Détails du périphérique : {{ $poste->nom_poste }}
    </div>

    <div class="card-body">
        <form>
            <div class="row">
                <div class="mt-3 col-6">
                    <label class="form-label">N° de série</label>
                    <input type="text" class="form-control" value="{{ $poste->num_serie_poste }}" disabled>
                </div>

                <div class="mt-3 col-6">
                    <label class="form-label">N° d'inventaire</label>
                    <input type="text" class="form-control" value="{{ $poste->num_inventaire_poste }}" disabled>
                </div>

                <div class="mt-3 col-6">
                    <label class="form-label">Nom du périphérique</label>
                    <input type="text" class="form-control" value="{{ $poste->nom_poste }}" disabled>
                </div>

                <div class="mt-3 col-6">
                    <label class="form-label">Désignation</label>
                    <input type="text" class="form-control" value="{{ $poste->designation_poste }}" disabled>
                </div>

                <div class="mt-3 col-6">
                    <label class="form-label">État</label>
                    <input type="text" class="form-control" value="{{ $poste->etat_poste ?? 'N/A' }}" disabled>
                </div>

                <div class="mt-3 col-6">
                    <label class="form-label">Statut</label>
                    <input type="text" class="form-control" value="{{ $poste->statut_poste ?? 'N/A' }}" disabled>
                </div>


                <div class="mt-3 col-6">
                    <label class="form-label">Type</label>
                    <select class="form-select" disabled>
                        @foreach($types as $type)
                            <option value="{{ $type->id }}" {{ $poste->type_poste_id == $type->id ? 'selected' : '' }}>
                                {{ $type->libelle_type }}
                            </option>
                        @endforeach
                    </select>
                </div>



                <div class="mt-3 col-6">
                    <label class="form-label">Date d'acquisition</label>
                    <input type="date" class="form-control" value="{{ \Carbon\Carbon::parse($poste->date_acq)->format('Y-m-d') }}" disabled>
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

         width: '100%'
    });
</script>
@endsection
