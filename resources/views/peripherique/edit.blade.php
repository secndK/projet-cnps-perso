
@extends('layouts.app')
@section('title', 'Gestion des périphériques')

@section('content')
<div class="container">


    <div class="card">
        <div class="card-header">
            <h3>Modifier le périphérique</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('peripherique.update', $peripheriques->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mt-3 row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="NumSeriePeripherique" class="form-label">N° de série</label>
                            <input type="text" name="num_serie_peripherique" class="form-control" id="NumSeriePeripherique" value="{{ $peripheriques->num_serie_peripherique }}">
                        </div>
                    </div>

                    <div class="mt-3 col-6">
                        <div class="form-group">
                            <label for="NumInventairePeripherique" class="form-label">N° d'inventaire</label>
                            <input type="text" name="num_inventaire_peripherique" class="form-control" id="NumInventairePeripherique" value="{{ $peripheriques->num_inventaire_peripherique }}">
                        </div>
                    </div>

                    <div class="mt-3 col-6">
                        <div class="form-group">
                            <label for="NomPeripherique" class="form-label">Nom du périphérique</label>
                            <input type="text" name="nom_peripherique" class="form-control" id="NomPeripherique" value="{{ $peripheriques->nom_peripherique }}">
                        </div>
                    </div>

                    <div class="mt-3 col-6">
                        <div class="form-group">
                            <label for="DesignationPeripherique" class="form-label">Désignation</label>
                            <input type="text" name="designation_peripherique" class="form-control" id="DesignationPeripherique" value="{{ $peripheriques->designation_peripherique }}">
                        </div>
                    </div>

                    <div class="mt-3 col-6">
                        <div class="form-group">
                            <label for="EtatPeripherique" class="form-label">État</label>
                            <select name="etat_peripherique" class="form-control" id="EtatPeripherique">
                                <option value="En service" {{ $peripheriques->etat_peripherique == 'En service' ? 'selected' : '' }}>En service</option>
                                <option value="En panne" {{ $peripheriques->etat_peripherique == 'En panne' ? 'selected' : '' }}>En panne</option>
                                <option value="Réformé" {{ $peripheriques->etat_peripherique == 'Réformé' ? 'selected' : '' }}>Réformé</option>
                                <option value="Non attribué" {{ $peripheriques->etat_peripherique == 'Non attribué' ? 'selected' : '' }}>Non attribué</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-3 col-6">
                        <div class="form-group">
                            <label for="TypePeripherique" class="form-label">Type</label>


                            <select name="type_peripherique" class="form-control" id="TypePeripherique">
                                <option value="">-- choisir -- </option>
                                <option value="ecran" {{ $peripheriques->type_peripherique == 'ecran' ? 'selected' : '' }}>Ecran</option>
                                <option value="clavier" {{ $peripheriques->type_peripherique == 'clavier' ? 'selected' : '' }}>Clavier</option>
                                <option value="souris" {{ $peripheriques->type_peripherique == 'souris' ? 'selected' : '' }}>Souris</option>
                                <option value="telephone ip" {{ $peripheriques->type_peripherique == 'telephone ip' ? 'selected' : '' }}>Tel Ip</option>
                                <option value="imprimante" {{ $peripheriques->type_peripherique == 'imprimante' ? 'selected' : '' }}>Imprimante</option>

                            </select>
                        </div>
                    </div>

                    <div class="mt-3 col-6">
                        <div class="form-group">
                            <label for="DateAcq" class="form-label">Date d'acquisition</label>
                            <input type="date" name="date_acq" class="form-control" id="DateAcq" value="{{ \Carbon\Carbon::parse($peripheriques->date_acq)->format('Y-m-d') }}">
                        </div>
                    </div>
                </div>


            </form>

        </div>
        <div class="card-footer">
            <div class=" d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Valider</button>
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Annuler</a>

            </div>


        </div>
    </div>

</div>
@endsection
