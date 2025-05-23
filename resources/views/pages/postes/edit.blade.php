@extends('layouts.app')
@section('title', 'Gestion des postes de travail')


@section('voidgrubs')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('postes.index') }}">Postes de travail</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edition de poste de travail</li>
  </ol>
</nav>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        Modifier le poste : {{ $poste->nom_poste }}
    </div>

    <div class="card-body">
        <form action="{{ route('postes.update', $poste->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-6">
                    <label for="num_serie_poste" class="form-label">Numéro de série</label>
                    <input type="text" name="num_serie_poste" class="form-control" id="num_serie_poste" value="{{ old('num_serie_poste', $poste->num_serie_poste) }}" required>
                </div>

                <div class="col-6">
                    <label for="num_inventaire_poste" class="form-label">Numéro d'inventaire</label>
                    <input type="text" name="num_inventaire_poste" class="form-control" id="num_inventaire_poste" value="{{ old('num_inventaire_poste', $poste->num_inventaire_poste) }}" required>
                </div>

                <div class="mt-3 col-6">
                    <label for="nom_poste" class="form-label">Nom du poste</label>
                    <input type="text" name="nom_poste" class="form-control" id="nom_poste" value="{{ old('nom_poste', $poste->nom_poste) }}" required>
                </div>

                <div class="mt-3 col-6">
                    <label for="designation_poste" class="form-label">Désignation</label>
                    <input type="text" name="designation_poste" class="form-control" id="designation_poste" value="{{ old('designation_poste', $poste->designation_poste) }}">
                </div>

                <div class="mt-3 col-6">
                    <label for="etat_poste" class="form-label">État</label>
                    <select name="etat_poste" id="etat_poste" class="js-example-basic-single form-select">
                        <option value="">-- Choisir --</option>
                        @foreach(['en panne', 'en service', 'Bon'] as $etat)
                            <option value="{{ $etat }}" {{ old('etat_poste', $poste->etat_poste) == $etat ? 'selected' : '' }}>{{ $etat }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mt-3 col-6">
                    <label for="statut_poste" class="form-label">Statut</label>
                    <select name="statut_poste" id="statut_poste" class="js-example-basic-single form-select">
                        <option value="">-- Choisir --</option>
                        @foreach(['attribué', 'disponible'] as $statut)
                            <option value="{{ $statut }}" {{ old('statut_poste', $poste->statut_poste) == $statut ? 'selected' : '' }}>{{ $statut }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mt-3 col-6">
                    <label for="type_poste_id" class="form-label">Type</label>
                    <select name="type_poste_id" id="type_poste_id" class="js-example-basic-single form-select" required>
                        <option value="">-- Choisir --</option>
                        @foreach($types as $type)
                            <option value="{{ $type->id }}" {{ old('type_poste_id', $poste->type_poste_id) == $type->id ? 'selected' : '' }}>
                                {{ $type->libelle_type }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mt-3 col-6">
                    <label for="date_acq" class="form-label">Date d'acquisition</label>
                    <input type="date" name="date_acq" class="form-control" id="date_acq" value="{{ old('date_acq', \Carbon\Carbon::parse($poste->date_acq)->format('Y-m-d')) }}" required>
                </div>

                <div class="mt-3 d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                    <a href="{{ route('postes.index') }}" class="btn btn-secondary">Annuler</a>
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
