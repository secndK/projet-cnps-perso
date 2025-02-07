@extends('layouts.app')

@section('title', 'Créer un nouveau poste')

@section('content')
<div class="card">
    <div class="card-header">
        Créer un nouveau poste
    </div>
    <div class="card-body">
        <form action="{{ route('postes.store') }}" method="POST">
            @csrf
            <div class="row">
                <!-- Numéro de série -->
                <div class="col-6">
                    <label for="num_serie_poste" class="form-label">Numéro de série</label>
                    <input type="text" name="num_serie_poste" class="form-control" id="num_serie_poste" required>
                </div>

                <!-- Numéro d'inventaire -->
                <div class="col-6">
                    <label for="num_inventaire_poste" class="form-label">Numéro d'inventaire</label>
                    <input type="text" name="num_inventaire_poste" class="form-control" id="num_inventaire_poste" required>
                </div>

                <!-- Nom du poste -->
                <div class="col-6 mt-3">
                    <label for="nom_poste" class="form-label">Nom du poste</label>
                    <input type="text" name="nom_poste" class="form-control" id="nom_poste" required>
                </div>

                <!-- Désignation -->
                <div class="col-6 mt-3">
                    <label for="designation_poste" class="form-label">Désignation</label>
                    <input type="text" name="designation_poste" class="form-control" id="designation_poste">
                </div>

                {{-- <!-- Type de poste -->
                <div class="col-6 mt-3">
                    <label for="type_poste" class="form-label">Type de poste</label>
                    <select name="type_poste" class="form-select" id="type_poste">
                </div> --}}

                <!-- État du poste -->
                <div class="col-6 mt-3">
                    <label for="etat_poste" class="form-label">État du poste</label>
                    <input type="text" name="etat_poste" class="form-control" id="etat_poste">
                </div>

                <!-- Date d'acquisition -->
                <div class="col-6 mt-3">
                    <label for="date_acq" class="form-label">Date d'acquisition</label>
                    <input type="date" name="date_acq" class="form-control" id="date_acq" required>
                </div>

                <!-- Agent -->
                <div class="col-6 mt-3">
                    <label for="agent_id" class="form-label">Agent</label>
                    <select name="agent_id" class="form-control" id="agent_id">
                        <option value="">-- Choisir un agent --</option>
                        @foreach($agents as $agent)
                            <option value="{{ $agent->id }}">{{ $agent->nom_agent }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Périphériques -->
                <div class="col-6 mt-3">
                    <label for="peripheriques" class="form-label">Périphériques</label>
                    <select name="peripheriques[]" class="js-example-basic-multiple form-control" id="peripheriques" multiple="multiple">
                        @foreach($peripheriques as $peripherique)
                            <option value="{{ $peripherique->id }}">{{ $peripherique->nom_peripherique }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Boutons -->
                <div class="mt-8 d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Créer</button>
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
});
</script>

@endsection