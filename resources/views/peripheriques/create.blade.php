@extends('layouts.app')

@section('title', 'Gestion des périphériques')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="mt-3 d-flex justify-content-between">
            <p> Ajoutez un nouveau périphérique</p>
            <button type="submit" class="btn btn-primary">Créer un nouveau type de peripherique</button>
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
                      {{-- <div class="mt-3 col-6">
                        <div class="form-group">
                            <label for="TypePeripherique" class="form-label">Type</label>
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addTypeModal">+</button>

                            <div class="d-flex">
                                <select name="type_peripherique_id" id="TypePeripherique" class="js-example-basic-single form-select me-2">
                                    <option value="">-- Choisir --</option>
                                    @foreach($types as $type)
                                        <option value="{{ $type->id }}">{{ $type->libelle }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div> --}}


                {{-- <div class="mt-3 col-6">
                    <div class="form-group">
                        <label for="agent_id" class="form-label">Attribuer à propriétaire</label>
                        <select name="agent_id" class="js-example-basic-single form-control">
                            <option value="">-- Choisir --</option>
                            @foreach($agents as $agent)
                                <option value="{{ $agent->id }}">{{ $agent->nom_agent }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mt-3 col-6">
                    <div class="form-group">
                        <label for="poste_id" class="form-label">Attribuer à poste</label>
                        <select name="poste_id" class="js-example-basic-single form-control">
                            <option value="">-- Choisir --</option>
                            @foreach($postes as $poste)
                                <option value="{{ $poste->id }}">{{ $poste->nom_poste }}</option>
                            @endforeach
                        </select>
                    </div>
                </div> --}}
                <div class="mt-3 col-6">
                    <div class="form-group">
                        <label for="DateAcq" class="form-label">Date acquisition</label>
                        <input type="date" name="date_acq" class="form-control" id="DateAcq">
                    </div>
                </div>










                {{-- <!-- Modale pour ajouter un nouveau type -->
                <div class="modal fade" id="addTypeModal" tabindex="-1" aria-labelledby="addTypeModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addTypeModalLabel">Ajouter un type de périphérique</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="newType" class="form-label">Nom du type</label>
                                    <input type="text" id="newType" class="form-control">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                <button type="button" class="btn btn-primary" id="saveNewType">Ajouter</button>
                            </div>
                        </div>
                    </div>
                </div>

 --}}



                <div class="mt-3 d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Créer</button>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Annuler</a>
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
