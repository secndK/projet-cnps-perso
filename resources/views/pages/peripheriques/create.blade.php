@extends('layouts.app')


@section('title', 'Gestion des périphériques')
@section('module', 'Créer un périphérique')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="mt-3 d-flex justify-content-between">
            <p> Ajouter un nouveau périphérique</p>
            <form action="{{ route('types-peripheriques.create') }}" method="GET">
                <button type="submit" class="btn btn-primary btn-sm">Créer un nouveau type de peripherique</button>
            </form>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('peripheriques.store') }}" method="POST">
            @csrf
            <div class="mt-1 row">
                <div class="mt-3 col-6">
                    <div class="form-group">
                        <label for="NumSeriePeripherique" class="form-label">N° de série</label>
                        <input type="text" name="num_serie_peripherique" class="form-control" id="NumSeriePeripherique" required>
                    </div>
                </div>
                <div class="mt-3 col-6">
                    <div class="form-group">
                        <label for="NumInventairePeripherique" class="form-label">N° d'inventaire</label>
                        <input type="text" name="num_inventaire_peripherique" class="form-control" id="NumInventairePeripherique" required>
                    </div>
                </div>
                <div class="mt-3 col-6">
                    <div class="form-group">
                        <label for="NomPeripherique" class="form-label">Nom périphérique</label>
                        <input type="text" name="nom_peripherique" class="form-control" id="NomPeripherique" required>
                    </div>
                </div>
                <div class="mt-3 col-6">
                    <div class="form-group">
                        <label for="DesignationPeripherique" class="form-label">Désignation</label>
                        <input type="text" name="designation_peripherique" class="form-control" id="DesignationPeripherique">
                    </div>
                </div>
                <div class="mt-3 col-6">
                    <div class="form-group">
                        <label for="EtatPeripherique" class="form-label">État</label>
                        <select name="etat_peripherique" id="EtatPeripherique" class="js-example-basic-single form-select">
                            <option value="">-- Choisir --</option>
                            <option value="En panne">En panne</option>
                            <option value="En service">En service</option>
                            <option value="Réformé">Réformé</option>
                            <option value="Non attribué">Non attribué</option>
                        </select>
                    </div>
                </div>
                      <!-- Sélection du type de périphérique avec ajout via modal -->
                     <div class="mt-3 col-6">
                        <div class="form-group">
                            <label for="TypePeripherique" class="form-label">Type</label>
                                <select name="types_peripherique_id" id="TypePeripherique" class="js-example-basic-single form-select me-2">
                                    <option value="">-- Choisir --</option>
                                    @foreach($types as $type)
                                        <option value="{{ $type->id }}">{{ $type->libelle_type }}</option>
                                    @endforeach
                                </select>
                        </div>
                    </div>

                <div class="mt-3 col-6">
                    <div class="form-group">
                        <label for="DateAcq" class="form-label">Date acquisition</label>
                        <input type="date" name="date_acq" class="form-control" id="DateAcq">
                    </div>
                </div>

                <div class="mt-3 d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Créer</button>
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

    // document.getElementById('saveNewType').addEventListener('click', function() {
    //     let newType = document.getElementById('newType').value;
    //     if(newType) {
    //         let option = new Option(newType, newType, true, true);
    //         $('#TypePeripherique').append(option).trigger('change');
    //         $('#addTypeModal').modal('hide');
    //         document.getElementById('newType').value = '';
    //     }
    // });
</script>
@endsection
