@extends('layouts.app')
@section('title', 'Gestion des périphériques')

@section('voidgrubs')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('peripheriques.index') }}">Peripherique</a></li>
    <li class="breadcrumb-item active" aria-current="page">Détails de peripherique</li>
  </ol>
</nav>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h4><strong>Détails de: {{ $peripheriques->nom_peripherique }}</strong></h4>
    </div>
    <div class="card-body">
        <form>
            <div class="row">
                <div class="mt-3 col-6">
                    <label for="num_serie_peripherique" class="form-label">N° de série</label>
                    <input type="text" name="num_serie_peripherique" class="form-control" id="num_serie_peripherique" value="{{ $peripheriques->num_serie_peripherique }}" disabled>
                </div>

                <div class="mt-3 col-6">
                    <label for="num_inventaire_peripherique" class="form-label">N° d'inventaire</label>
                    <input type="text" name="num_inventaire_peripherique" class="form-control" id="num_inventaire_peripherique" value="{{ $peripheriques->num_inventaire_peripherique }}" disabled>
                </div>

                <div class="mt-3 col-6">
                    <label for="nom_peripherique" class="form-label">Nom du périphérique</label>
                    <input type="text" name="nom_peripherique" class="form-control" id="nom_peripherique" value="{{ $peripheriques->nom_peripherique }}" disabled>
                </div>

                <div class="mt-3 col-6">
                    <label for="designation_peripherique" class="form-label">Désignation</label>
                    <input type="text" name="designation_peripherique" class="form-control" id="designation_peripherique" value="{{ $peripheriques->designation_peripherique }}" disabled>
                </div>

                <div class="mt-3 col-6">
                    <label for="etat_peripherique" class="form-label">État</label>
                    <select name="etat_peripherique" class="form-select" disabled>
                        <option value="en panne" {{ $peripheriques->etat_peripherique == 'en panne' ? 'selected' : '' }}>En panne</option>
                        <option value="en service" {{ $peripheriques->etat_peripherique == 'en service' ? 'selected' : '' }}>En service</option>
                        <option value="Bon" {{ $peripheriques->etat_peripherique == 'Bon' ? 'selected' : '' }}>Bon</option>
                    </select>
                </div>

               <div class="mt-3 col-6">
                    <label for="statu_peripherique" class="form-label">Statut</label>
                    <select name="statut_peripherique" class="form-select" disabled>
                        <option value="disponible" {{ $peripheriques->statut_peripherique == 'disponible' ? 'selected' : '' }}>Disponible</option>
                        <option value="attribué" {{ $peripheriques->statut_peripherique == 'attribué' ? 'selected' : '' }}>Attribué</option>
                        <option value="réformé" {{ $peripheriques->statut_peripherique == 'reformé' ? 'selected' : '' }}>Reformé</option>

                    </select>
                </div>

                 <div class="mt-3 col-6">
                    <label class="form-label">Propriétaire</label>
                    <input type="text" class="form-control" value="{{ $peripheriques->agent->matricule_agent ?? 'N/A' }}" disabled>
                </div>

                 <div class="mt-3 col-6">
                    <label class="form-label">Direction</label>
                    <input type="text" class="form-control" value="{{ $peripheriques->agent->direction_agent ?? 'N/A' }}" disabled>
                </div>

                <div class="mt-3 col-6">
                    <label class="form-label">Localisation</label>
                    <input type="text" class="form-control" value="{{ $peripheriques->agent->localisation_agent ?? 'N/A' }}" disabled>
                </div>




                <div class="mt-3 col-6">
                    <label for="TypePeripherique" class="form-label">Type</label>
                    <select name="type_peripherique_id" id="TypePeripherique" class="form-select" disabled>
                        <option value="">-- Choisir --</option>
                        @foreach($types as $type)
                            <option value="{{ $type->id }}"
                                {{ $peripheriques->type_peripherique_id == $type->id ? 'selected' : '' }}>
                                {{ $type->libelle_type }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-3 col-6">
                    <label for="date_acq" class="form-label">Date d'acquisition</label>
                    <input type="date" name="date_acq" class="form-control" id="date_acq" value="{{ \Carbon\Carbon::parse($peripheriques->date_acq)->format('Y-m-d') }}" disabled>
                </div>

                <div class="mt-3 d-flex justify-content-between">
                    <a href="{{ route('peripheriques.index') }}" class="btn btn-secondary">Retour</a>
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
