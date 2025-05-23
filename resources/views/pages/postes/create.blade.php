
@extends('layouts.app')
@section('title', 'Gestion des postes de travail')


@section('voidgrubs')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('postes.index') }}">Postes de travail</a></li>
    <li class="breadcrumb-item active" aria-current="page">Creation de poste de travail</li>
  </ol>
</nav>
@endsection

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>
@endif


@section('content')

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <p> Créer un nouveau poste</p>
            <form action="{{ route('types-postes.create') }}" method="GET">
                <button type="submit" class="btn btn-primary btn-sm">Créer un nouveau type de poste</button>
            </form>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('postes.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="mt-3 col-6">
                    <label for="num_serie_poste" class="form-label">Numéro de série</label>
                    <input type="text" name="num_serie_poste" class="form-control" id="num_serie_poste" required>
                </div>


                <div class="mt-3 col-6">
                    <label for="num_inventaire_poste" class="form-label">Numéro d'inventaire</label>
                    <input type="text" name="num_inventaire_poste" class="form-control" id="num_inventaire_poste" required>
                </div>

                <div class="mt-3 col-6">
                    <label for="nom_poste" class="form-label">Nom du poste</label>
                    <input type="text" name="nom_poste" class="form-control" id="nom_poste" required>
                </div>

                <div class="mt-3 col-6">
                    <label for="designation_poste" class="form-label">Désignation</label>
                    <input type="text" name="designation_poste" class="form-control" id="designation_poste">
                </div>

                <div class="mt-3 col-6">
                    <div class="form-group">
                        <label for="EtatPoste" class="form-label">État</label>
                        <select name="etat_poste" id="EtatPoste" class="js-example-basic-single form-select" >
                            <option value="">-- Choisir --</option>
                            <option value="Bon">Bon</option>
                            <option value="en panne">En panne</option>
                            <option value="en service">En service</option>
                        </select>
                    </div>
                </div>

                 <div class="mt-3 col-6">
                    <div class="form-group">
                        <label for="StatutPoste" class="form-label">Statut</label>
                        <select name="statut_poste" id="StatutPoste" class="js-example-basic-single form-select" >
                            <option value="">-- Choisir --</option>
                            <option value="attribué">Attribué</option>
                            <option value="disponible">disponible</option>
                        </select>
                    </div>
                </div>

                <div class="mt-3 col-6 ">
                    <div class="form-group">
                        <label for="TypePoste" class="form-label">Type</label>
                            <select name="type_poste_id" id="TypePoste" class="js-example-basic-single form-select me-2" required>
                                <option value="">-- Choisir --</option>
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->libelle_type }}</option>
                                @endforeach
                            </select>
                    </div>
                </div>


                <div class="mt-3 col-6">
                    <label for="date_acq" class="form-label">Date d'acquisition</label>
                    <input type="date" name="date_acq" class="form-control" id="date_acq" >
                </div>


                <div class="mt-3 d-flex justify-content-between">
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
        $('.js-example-basic-single').select2({
            width: '100%' // REND LE SELECT2 RESPONSIVE
        });
    });
</script>

@endsection
