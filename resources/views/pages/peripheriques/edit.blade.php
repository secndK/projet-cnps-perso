@extends('layouts.app')

@section('title', 'Gestion des périphériques')
@section('module', 'Modifier un périphérique')

@section('content')
<div class="card">
    {{-- <div class="card-header">
        Modifier le périphérique : {{ $peripheriques->nom_peripherique }}
    </div> --}}
    <div class="card-body">
        <form action="{{ route('peripheriques.update', $peripheriques->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="mt-3 col-6">
                    <label for="num_serie_peripherique" class="form-label">N° de série</label>
                    <input type="text" name="num_serie_peripherique" class="form-control" id="num_serie_peripherique" value="{{ $peripheriques->num_serie_peripherique }}" required>
                </div>

                <div class="mt-3 col-6">
                    <label for="num_inventaire_peripherique" class="form-label">N° d'inventaire</label>
                    <input type="text" name="num_inventaire_peripherique" class="form-control" id="num_inventaire_peripherique" value="{{ $peripheriques->num_inventaire_peripherique }}" required>
                </div>

                <div class="mt-3 col-6">
                    <label for="nom_peripherique" class="form-label">Nom du périphérique</label>
                    <input type="text" name="nom_peripherique" class="form-control" id="nom_peripherique" value="{{ $peripheriques->nom_peripherique }}" required>
                </div>

                <div class="mt-3 col-6">
                    <label for="designation_peripherique" class="form-label">Désignation</label>
                    <input type="text" name="designation_peripherique" class="form-control" id="designation_peripherique" value="{{ $peripheriques->designation_peripherique }}">
                </div>

                <div class="mt-3 col-6">
                    <label for="etat_peripherique" class="form-label">État</label>
                    <select name="etat_peripherique" class="form-select">
                        <option value="En panne" {{ $peripheriques->etat_peripherique == 'En panne' ? 'selected' : '' }}>En panne</option>
                        <option value="En service" {{ $peripheriques->etat_peripherique == 'En service' ? 'selected' : '' }}>En service</option>
                        <option value="Réformé" {{ $peripheriques->etat_peripherique == 'Réformé' ? 'selected' : '' }}>Réformé</option>
                        <option value="Non attribué" {{ $peripheriques->etat_peripherique == 'Non attribué' ? 'selected' : '' }}>Non attribué</option>
                    </select>
                </div>

               " <div class="mt-3 col-6">
                    <label for="TypePeripherique" class="form-label">Type</label>
                    <select name="type_peripherique_id" id="TypePeripherique" class="form-select">
                        <option value="">-- Choisir --</option>
                        @foreach($types as $type)
                            <option value="{{ $type->id }}"
                                {{ $peripheriques->type_peripherique_id == $type->id ? 'selected' : '' }}>
                                {{ $type->libelle_type }}
                            </option>
                        @endforeach
                    </select>
                </div>"
                <div class="mt-3 col-6">
                    <div class="form-group">
                        <label for="date_acq" class="form-label">Date d'acquisition</label>
                        <input type="date" name="date_acq" class="form-control" id="DateAcq" value="{{ \Carbon\Carbon::parse($peripheriques->date_acq)->format('Y-m-d') }}">
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
