@extends('layouts.app')

@section('title', 'Gestion des périphériques')

@section('content')


<div class="card">

    <div class="card-header">
        Ajoutez un nouveau périphérique
    </div>


    <div class="card-body">

        <form action="{{ route('peripherique.store') }}" method="POST">
            @csrf
            <div class="mt-1 row">

                <div class="mt-3 col-6">
                    <div class="form-group">
                        <label for="NumSeriePeripherique" class="form-label">N° de serie</label>
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
                        <label for="NomPeripherique" class="form-label">Nom periphérique</label>
                        <input type="text" name="nom_peripherique" class="form-control" id="NomPeripherique" required>
                    </div>
                </div>


                <div class="mt-3 col-6">
                    <div class="form-group">
                        <label for="DesignationPeripherique" class="form-label">Designation</label>
                        <input type="text" name="designation_peripherique" class="form-control" id="DesignationPeripherique" >
                    </div>
                </div>

                <div class="mt-3 col-6">

                    <div class="">
                        <label for="TypePeripherique" class="form-label">Type</label>
                        <select name="type_peripherique" id="TypePeripherique" class="form-select" >
                            <option value="">Sélectionnez une catégorie</option>
                            <option value="ecran">Ecran</option>
                            <option value="clavier">Clavier</option>
                            <option value="souris">Souris</option>
                            <option value="telephone ip">Telephone Ip</option>
                            <option value="imprimante">Imprimante</option>
                        </select>
                    </div>
                </div>

                <div class="mt-3 col-6">
                    <div class="form-group">
                        <label for="EtatPeripherique" class="form-label">Etat</label>
                        <select name="etat_peripherique" id="EtatPeripherique" class="form-select" >
                            <option value="">Sélectionnez l'Etat de l'appareil</option>
                            <option value="En panne">En panne</option>
                            <option value="En Service">En service</option>
                            <option value="Réformé">Reformé</option>
                            <option value="En panne">Non attribué</option>
                        </select>
                     </div>
                </div>

                <div class="mt-3 col-6">
                    <div class="form-group">
                        <label for="DateAcq" class="form-label">Date acquisition</label>
                        <input type="date" name="date_acq" class="form-control" id="DateAcq" >
                    </div>
                </div>


                <div class="mt-3 d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Créer</button>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Annuler</a>

                </div>


            </div>
        </form>
    </div>
</div>


@endsection
