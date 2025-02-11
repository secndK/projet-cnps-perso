@extends('layouts.app')

@section('title', 'Modifier poste de travail')

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
                            <label for="etat_poste" class="form-label">État</label>
                            <select name="etat_poste" class="form-select">
                                <option value="En panne" {{ $postes->etat_poste == 'En panne' ? 'selected' : '' }}>En panne</option>
                                <option value="En service" {{ $postes->etat_poste == 'En service' ? 'selected' : '' }}>En service</option>
                                <option value="Réformé" {{ $postes->etat_poste == 'Réformé' ? 'selected' : '' }}>Réformé</option>
                                <option value="Non attribué" {{ $postes->etat_poste == 'Non attribué' ? 'selected' : '' }}>Non attribué</option>
                            </select>
                        </div>
                    </div>



                    <div class="mt-3 col-6">
                        <div class="form-group">
                            <label for="type_poste" class="form-label">Type</label>
                            <select name="type_poste" class="form-select">
                                <option value="ecran" {{ $postes->type_poste == 'bureau' ? 'selected' : '' }}>Écran</option>
                                <option value="clavier" {{ $postes->type_poste == 'portable' ? 'selected' : '' }}>Clavier</option>
                            </select>
                        </div>
                    </div>


                    <div class="mt-3 col-6">
                        <div class="form-group">
                            <label for="agent_id" class="form-label">Propriétaire</label>
                            <select name="agent_id" class="js-example-basic-single form-control">
                                <option value="">Aucun</option>
                                @foreach($agents as $agent)
                                    <option value="{{ $agent->id }}" {{ $postes->agent_id == $agent->id ? 'selected' : '' }}>{{ $agent->nom_agent }}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>

                    <div class="mt-3 col-6">
                        <div class="form-group">
                            <label for="peripheriques" class="form-label">Périphériques</label>
                            <select name="peripheriques[]" class="js-example-basic-multiple form-control" multiple="multiple">
                                @foreach($peripheriques as $peripherique)
                                    <option value="{{ $peripherique->id }}" selected>{{ $peripherique->nom_peripherique }}</option>
                                @endforeach
                            </select>
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
