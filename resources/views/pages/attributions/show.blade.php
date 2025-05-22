@extends('layouts.app')

@section('title', 'Gestion des accès')
@section('module', 'Détails attribution des équipements')

@section('content')

<div class="card">
    <div class="card-header bg-light d-flex justify-content-start align-items-center">
        <div>
            <h5>Détails de l'attribution</h5>
        </div>
    </div>

    <div class="card-body">
        <form>
            <div class="mt-1 row">
                <div class="mt-3 col-12">
                    <div class="form-group">
                        <label for="agent_id">Agent Bénéficiaire</label>
                        <select name="agent_id" id="agent_id" class="js-example-basic-single form-control" disabled>
                            <option value="">Sélectionner un utilisateur</option>
                            @foreach ($agents as $agent)
                                <option value="{{ $agent->id }}" {{ $attribution->agent_id == $agent->id ? 'selected' : '' }}>
                                    {{ $agent->nom_agent }} {{ $agent->prenom_agent }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="mt-3 col-12">
                    <div class="form-group">
                        <label for="postes">Postes</label>
                        <select name="postes[]" id="postes" class="js-example-basic-multiple form-control" multiple disabled>
                            @foreach ($postes as $poste)
                                <option value="{{ $poste->id }}" {{ in_array($poste->id, $attribution->postes->pluck('id')->toArray()) ? 'selected' : '' }}>
                                    {{ $poste->designation_poste }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mt-3 col-12">
                    <div class="form-group">
                        <label for="peripheriques">Périphériques</label>
                        <select name="peripheriques[]" id="peripheriques" class="js-example-basic-multiple form-control" multiple disabled>
                            @foreach ($peripheriques as $peripherique)
                                <option value="{{ $peripherique->id }}" {{ in_array($peripherique->id, $attribution->peripheriques->pluck('id')->toArray()) ? 'selected' : '' }}>
                                    {{ $peripherique->nom_peripherique }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mt-3 col-12">
                    <div class="form-group">
                        <label for="date_attribution">Date d'attribution</label>
                        <input type="date" name="date_attribution" id="date_attribution"
                               class=" form-control"
                               value="{{ $attribution->date_attribution->format('Y-m-d') }}"
                               disabled>
                    </div>
                </div>

                <div class="mt-3 col-12">
                    <div class="form-group">
                        <label for="date_retrait">Date de retrait</label>
                        <input type="date" name="date_retrait" id="date_retrait"
                            class="form-control"
                            value="{{ $attribution->date_retrait ? $attribution->date_retrait->format('Y-m-d') : '' }}"
                            disabled>
                    </div>
            </div>

                <div class="mt-3 d-flex justify-content-between">
                    <a href="{{ route('attributions.index') }}" class="btn btn-secondary">Retour</a>
                </div>
            </div>
        </form>
    </div>
</div>

@section('select')
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2({
            disabled: true
        });
        $('.js-example-basic-multiple').select2({
            disabled: true
        });
    });
</script>
@endsection

@endsection
