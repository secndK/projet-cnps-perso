@extends('layouts.app')

@section('title', 'Gestion des accès')
@section('module', 'Attribution des équipements')

@section('content')

<div class="card">
    <div class="card-header bg-light d-flex justify-content-start align-items-center">
        <div>
            <p>Modifier l'attribution</p>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('attributions.update', $attribution) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mt-1 row">
                <div class="mt-3 col-6">
                    <div class="form-group">
                        <label for="libelle_attribution">Libellé</label>
                        <input type="text" name="libelle_attribution" id="libelle_attribution" class="form-control" value="{{ $attribution->libelle_attribution }}" required>
                    </div>
                </div>

                <div class="mt-3 col-6">
                    <div class="form-group">
                        <label for="agent_id">Agent</label>
                        <select name="agent_id" id="agent_id" class="js-example-basic-single form-control" required>
                            <option value="">Sélectionner un agent</option>
                            @foreach ($agents as $agent)
                                <option value="{{ $agent->id }}" {{ $attribution->agent_id == $agent->id ? 'selected' : '' }}>{{ $agent->nom_agent }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mt-3 col-6">
                    <div class="form-group">
                        <label for="postes">Postes</label>
                        <select name="postes[]" id="postes" class="js-example-basic-multiple form-control" multiple required>
                            @foreach ($postes as $poste)
                                <option value="{{ $poste->id }}" {{ in_array($poste->id, $attribution->postes->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $poste->designation_poste }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mt-3 col-6">
                    <div class="form-group">
                        <label for="peripheriques">Périphériques</label>
                        <select name="peripheriques[]" id="peripheriques" class="js-example-basic-multiple form-control" multiple required>
                            @foreach ($peripheriques as $peripherique)
                                <option value="{{ $peripherique->id }}" {{ in_array($peripherique->id, $attribution->peripheriques->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $peripherique->nom_peripherique }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mt-3 col-6">
                    <div class="form-group">
                        <label for="date_attribution">Date Attribution</label>
                        <input type="date" name="date_attribution" id="date_attribution" class="form-control" value="{{ $attribution->date_attribution }}" required>
                    </div>
                </div>

                <div class="mt-3 col-6">
                    <div class="form-group">
                        <label for="date_retrait">Date Retrait</label>
                        <input type="date" name="date_retrait" id="date_retrait" class="form-control" value="{{ $attribution->date_retrait }}">
                    </div>
                </div>

                <div class="mt-3 d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
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

    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
</script>
@endsection
