@extends('layouts.app')

@section('title', 'Modifier un périphérique')

@section('content')
<div class="card">
    <div class="card-header">
        Modifier le périphérique : {{ $peripheriques->nom_peripherique }}
    </div>

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

                <div class="col-6 mt-3">
                    <label for="nom_peripherique" class="form-label">Nom du périphérique</label>
                    <input type="text" name="nom_peripherique" class="form-control" id="nom_peripherique" value="{{ $peripheriques->nom_peripherique }}" required>
                </div>

                <div class="col-6 mt-3">
                    <label for="designation_peripherique" class="form-label">Désignation</label>
                    <input type="text" name="designation_peripherique" class="form-control" id="designation_peripherique" value="{{ $peripheriques->designation_peripherique }}">
                </div>

                <div class="col-6 mt-3">
                    <label for="etat_peripherique" class="form-label">État</label>
                    <select name="etat_peripherique" class="form-select">
                        <option value="En panne" {{ $peripheriques->etat_peripherique == 'En panne' ? 'selected' : '' }}>En panne</option>
                        <option value="En service" {{ $peripheriques->etat_peripherique == 'En service' ? 'selected' : '' }}>En service</option>
                        <option value="Réformé" {{ $peripheriques->etat_peripherique == 'Réformé' ? 'selected' : '' }}>Réformé</option>
                        <option value="Non attribué" {{ $peripheriques->etat_peripherique == 'Non attribué' ? 'selected' : '' }}>Non attribué</option>
                    </select>
                </div>

                <div class="col-6 mt-3">
                    <label for="type_peripherique" class="form-label">Type</label>
                    <select name="type_peripherique" class="form-select">
                        <option value="ecran" {{ $peripheriques->type_peripherique == 'ecran' ? 'selected' : '' }}>Écran</option>
                        <option value="clavier" {{ $peripheriques->type_peripherique == 'clavier' ? 'selected' : '' }}>Clavier</option>
                        <option value="souris" {{ $peripheriques->type_peripherique == 'souris' ? 'selected' : '' }}>Souris</option>
                        <option value="telephone ip" {{ $peripheriques->type_peripherique == 'telephone ip' ? 'selected' : '' }}>Téléphone IP</option>
                        <option value="imprimante" {{ $peripheriques->type_peripherique == 'imprimante' ? 'selected' : '' }}>Imprimante</option>
                        <option value="domino wifi" {{ $peripheriques->type_peripherique == 'domino wifi' ? 'selected' : '' }}>Domino Wi-Fi</option>
                    </select>
                </div>

              <div class="col-6 mt-3">
                    <label for="agent_id" class="form-label">Propriétaire</label>
                    <select name="agent_id" class="js-example-basic-single form-control">
                        <option value="">-- Choisir --</option>
                        <option value="">Aucun</option>
                        @foreach($agents as $agent)
                            <option value="{{ $agent->id }}" {{ $peripheriques->agent_id == $agent->id ? 'selected' : '' }}>{{ $agent->nom_agent }}</option>
                        @endforeach
                    </select>
                </div> 

                <div class="col-6 mt-3">
                    <label for="poste_id" class="form-label">Poste</label>
                    <select name="poste_id" class="js-example-basic-single form-control" ">
                        <option value="">-- Choisir --</option>
                        <option value="">Aucun</option>
                        @foreach($postes as $poste)
                            <option value="{{ $poste->id }}" {{ $peripheriques->poste_id == $poste->id ? 'selected' : '' }}>{{ $poste->nom_poste }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-6 mt-3">
                    <div class="form-group">
                        <label for="date_acq" class="form-label">Date d'acquisition</label>
                        <input type="date" name="date_acq" class="form-control" id="DateAcq" value="{{ \Carbon\Carbon::parse($peripheriques->date_acq)->format('Y-m-d') }}">
                    </div>
                </div>

                <div class="mt-3 d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    <a href="{{ route('peripheriques.index') }}" class="btn btn-secondary">Annuler</a>
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
