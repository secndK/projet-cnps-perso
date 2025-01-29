@extends('layouts.app')

@section('title', 'Ajout poste de travail')

@section('content')



<div class="card">

    <div class="card-header">
        Ajoutez un nouveau périphérique
    </div>


    <div class="card-body">

        <form action="{{ route('poste_travail.store') }}" method="POST">
            @csrf
            <div class="mt-1 row">

                <div class="mt-3 col-6">
                    <div class="form-group">
                        <label for="NumSerieposte_travail" class="form-label">N° de serie</label>
                        <input type="text" name="num_serie_poste_travail" class="form-control" id="NumSerieposte_travail" required>
                    </div>
                </div>


                <div class="mt-3 col-6">
                    <div class="form-group">
                        <label for="NumInventaireposte_travail" class="form-label">N° d'inventaire</label>
                        <input type="text" name="num_inventaire_poste_travail" class="form-control" id="NumInventaireposte_travail" required>
                    </div>
                </div>


                <div class="mt-3 col-6">
                    <div class="form-group">
                        <label for="Nomposte_travail" class="form-label">Nom periphérique</label>
                        <input type="text" name="nom_poste_travail" class="form-control" id="Nomposte_travail" required>
                    </div>
                </div>


                <div class="mt-3 col-6">
                    <div class="form-group">
                        <label for="Designationposte_travail" class="form-label">Designation</label>
                        <input type="text" name="designation_poste_travail" class="form-control" id="Designationposte_travail" >
                    </div>
                </div>

                <div class="mt-3 col-6">

                    <div class="">
                        <label for="Typeposte_travail" class="form-label">Type d'ordinateur</label>
                        <select name="type_poste_travail" id="Typeposte_travail" class="form-select">
                            <option value="">Sélectionnez une catégorie</option>
                            <option value="bureau">Bureau</option>
                            <option value="portable">Portable</option>

                        </select>
                    </div>
                </div>

                <div class="mt-3 col-6">
                    <div class="form-group">
                        <label for="Etatposte_travail" class="form-label">Etat</label>
                        <select name="etat_poste_travail" id="Etatposte_travail" class="form-select" >
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
</div



@endsection
