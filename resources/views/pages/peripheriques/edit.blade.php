@extends('layouts.app')

@section('title', 'Gestion des périphériques')


@section('voidgrubs')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('peripheriques.index') }}">Peripherique</a></li>
    <li class="breadcrumb-item active" aria-current="page">Modification de peripherique</li>
  </ol>
</nav>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('peripheriques.update', $peripherique->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="mt-3 col-6">
                    <label for="num_serie_peripherique" class="form-label">N° de série</label>
                    <input type="text" name="num_serie_peripherique" class="form-control" id="num_serie_peripherique" value="{{ $peripherique->num_serie_peripherique }}" required>
                </div>

                <div class="mt-3 col-6">
                    <label for="num_inventaire_peripherique" class="form-label">N° d'inventaire</label>
                    <input type="text" name="num_inventaire_peripherique" class="form-control" id="num_inventaire_peripherique" value="{{ $peripherique->num_inventaire_peripherique }}" required>
                </div>

                <div class="mt-3 col-6">
                    <label for="nom_peripherique" class="form-label">Nom du périphérique</label>
                    <input type="text" name="nom_peripherique" class="form-control" id="nom_peripherique" value="{{ $peripherique->nom_peripherique }}" required>
                </div>

                <div class="mt-3 col-6">
                    <label for="designation_peripherique" class="form-label">Désignation</label>
                    <input type="text" name="designation_peripherique" class="form-control" id="designation_peripherique" value="{{ $peripherique->designation_peripherique }}">
                </div>

                <div class="mt-3 col-6">
                    <label for="etat_peripherique" class="form-label">État</label>
                    <select name="etat_peripherique" class="form-select">
                        <option value="En service" {{ $peripherique->etat_peripherique == 'Bon' ? 'selected' : '' }}>Bon</option>
                        <option value="En service" {{ $peripherique->etat_peripherique == 'en service' ? 'selected' : '' }}>En service</option>
                        <option value="En panne" {{ $peripherique->etat_peripherique == 'en panne' ? 'selected' : '' }}>En panne</option>
                    </select>
                </div>

                <div class="mt-3 col-6">
                    <label for="statu_peripherique" class="form-label">Statut</label>
                    <select name="statut_peripherique" class="form-select">
                        <option value="disponible" {{ $peripherique->etat_peripherique == 'disponible' ? 'selected' : '' }}>Disponible</option>
                        <option value="attribué" {{ $peripherique->etat_peripherique == 'attribué' ? 'selected' : '' }}>Attribué</option>
                        <option value="réformé" {{ $peripherique->etat_peripherique == 'reformé' ? 'selected' : '' }}>Reformé</option>

                    </select>
                </div>


                <div class="mt-3 col-6">
                    <label for="TypePeripherique" class="form-label">Type</label>
                    <select name="type_peripherique_id" id="TypePeripherique" class="form-select">
                        <option value="">-- Choisir --</option>
                        @foreach($types as $type)
                            <option value="{{ $type->id }}"
                                {{ $peripherique->type_peripherique_id == $type->id ? 'selected' : '' }}>
                                {{ $type->libelle_type }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mt-3 col-6">
                    <div class="form-group">
                        <label for="date_acq" class="form-label">Date d'acquisition</label>
                        <input type="date" name="date_acq" class="form-control" id="DateAcq" value="{{ \Carbon\Carbon::parse($peripherique->date_acq)->format('Y-m-d') }}">
                    </div>
                </div>

                <div class="mt-3 d-flex justify-content-between">
                    <a href="{{ route('peripheriques.index') }}" class="btn btn-secondary">Annuler</a>
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
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
