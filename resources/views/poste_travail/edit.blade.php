@extends('layouts.app')
@section('title', 'Modification poste de travail')
@section('content')
<div class="card">
    <div class="card-header">
        Modifier le poste de travail
    </div>
Copy<div class="card-body">
    <form action="{{ route('poste_travail.update', $poste->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mt-1 row">
            <div class="mt-3 col-6">
                <div class="form-group">
                    <label for="NumSerieposte_travail" class="form-label">N° de serie</label>
                    <input type="text" name="num_serie_poste_travail" class="form-control" id="NumSerieposte_travail"
                           value="{{ old('num_serie_poste_travail', $poste->num_serie_poste_travail) }}" required>
                </div>
            </div>

            <div class="mt-3 col-6">
                <div class="form-group">
                    <label for="NumInventaireposte_travail" class="form-label">N° d'inventaire</label>
                    <input type="text" name="num_inventaire_poste_travail" class="form-control" id="NumInventaireposte_travail"
                           value="{{ old('num_inventaire_poste_travail', $poste->num_inventaire_poste_travail) }}" required>
                </div>
            </div>

            <div class="mt-3 col-6">
                <div class="form-group">
                    <label for="Nomposte_travail" class="form-label">Nom poste de travail</label>
                    <input type="text" name="nom_poste_travail" class="form-control" id="Nomposte_travail"
                           value="{{ old('nom_poste_travail', $poste->nom_poste_travail) }}" required>
                </div>
            </div>

            <div class="mt-3 col-6">
                <div class="form-group">
                    <label for="Designationposte_travail" class="form-label">Designation</label>
                    <input type="text" name="designation_poste_travail" class="form-control" id="Designationposte_travail"
                           value="{{ old('designation_poste_travail', $poste->designation_poste_travail) }}">
                </div>
            </div>

            <div class="mt-3 col-6">
                <div class="">
                    <label for="Typeposte_travail" class="form-label">Type d'ordinateur</label>
                    <select name="type_poste_travail" id="Typeposte_travail" class="form-select">
                        <option value="">Sélectionnez une catégorie</option>
                        <option value="bureau" {{ old('type_poste_travail', $poste->type_poste_travail) == 'bureau' ? 'selected' : '' }}>Bureau</option>
                        <option value="portable" {{ old('type_poste_travail', $poste->type_poste_travail) == 'portable' ? 'selected' : '' }}>Portable</option>
                    </select>
                </div>
            </div>

            <div class="mt-3 col-6">
                <div class="form-group">
                    <label for="Etatposte_travail" class="form-label">Etat de la machine</label>
                    <select name="etat_poste_travail" id="Etatposte_travail" class="form-select">
                        <option value="">Sélectionnez l'Etat de l'appareil</option>
                        <option value="En panne" {{ old('etat_poste_travail', $poste->etat_poste_travail) == 'En panne' ? 'selected' : '' }}>En panne</option>
                        <option value="En Service" {{ old('etat_poste_travail', $poste->etat_poste_travail) == 'En Service' ? 'selected' : '' }}>En service</option>
                        <option value="Réformé" {{ old('etat_poste_travail', $poste->etat_poste_travail) == 'Réformé' ? 'selected' : '' }}>Reformé</option>
                        <option value="Non attribué" {{ old('etat_poste_travail', $poste->etat_poste_travail) == 'Non attribué' ? 'selected' : '' }}>Non attribué</option>
                    </select>
                </div>
            </div>

            <div class="mt-3 col-6">
                <div class="form-group">
                    <label for="DateAcq" class="form-label">Date acquisition</label>
                    <input type="date" name="date_acq" class="form-control" id="DateAcq"
                           value="{{ old('date_acq', $poste->date_acq) }}" required>
                </div>
            </div>


            <div class="mt-3 col-6">
                <div class="form-group">
                    <label for="peripheriques">Périphériques disponibles</label>
                    <select name="peripheriques[]" id="peripheriques" multiple>
                        @foreach($peripheriquesDisponibles as $peripherique)
                            <option value="{{ $peripherique->id }}" {{ in_array($peripherique->id, $poste->peripheriques->pluck('id')->toArray()) ? 'selected' : '' }}>
                                {{ $peripherique->nom_peripherique }}
                            </option>
                        @endforeach
                    </select>
                </div> <!-- Type de périphérique -->
            </div>







            <div class="mt-4 d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Mettre à jour</button>
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Annuler</a>
            </div>
        </div>
    </form>
</div>
</div>
@endsection
