@extends('layouts.app')

@section('title', 'Gestion des postes de travail')
@section('module', 'Editer un périphérique')

@section('content')

<div class="card">
    <div class="card-header">
        <div class="card-body">
            <form action="{{ route('postes.update', $postes->id )}}" method="POST" >
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="mt-3 col-6">
                        <div class="form-group">
                            <label for="num_serie_poste" class="form-label">N° de série</label>
                            <input type="text" name="num_serie_poste" class="form-control" id="num_serie_poste" value="{{ $postes->num_serie_poste }}" required>
                        </div>
                    </div>
                    <div class="mt-3 col-6">
                        <div class="form-group">
                            <label for="num_inventaire_postes" class="form-label">N° d'inventaire</label>
                            <input type="text" name="num_inventaire_poste" class="form-control" id="num_inventaire_poste" value="{{ $postes->num_inventaire_poste }}" required>
                        </div>
                    </div>

                    <div class="mt-3 col-6">
                        <div class="form-group">
                                <label for="nom_poste" class="form-label">Nom du périphérique</label>
                                <input type="text" name="nom_poste" class="form-control" id="nom_poste" value="{{ $postes->nom_poste }}" required>
                        </div>
                    </div>
                    <div class="mt-3 col-6">
                        <div class="form-group">
                            <label for="designation_poste" class="form-label">Désignation</label>
                            <input type="text" name="designation_poste" class="form-control" id="designation_poste" value="{{ $postes->designation_poste }}">
                        </div>
                    </div>




                    <div class="mt-3 col-6">
                        <div class="form-group">


                        </div>
                    </div>


                    <div class="mt-3 col-6">
                        <div class="form-group">


                        </div>
                    </div>








































                </div>
            </form>
        </div>
    </div>
</div>


@endsection
