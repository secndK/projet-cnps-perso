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
                <div class="mt-3 col-12">
                    <div class="form-group">
                        <label for="user_id">user</label>
                        <select name="user_id" id="user_id" class="js-example-basic-single form-control" required>
                            <option value="">Sélectionner un utilisateur</option>
                            @foreach ($users as $users)
                                <option value="{{ $users->id }}" {{ $attribution->user_id == $users->id ? 'selected' : '' }}>{{ $users->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="mt-3 col-12">
                    <div class="form-group">
                        <label for="postes">Postes</label>
                        <select name="postes[]" id="postes" class="js-example-basic-multiple form-control" multiple required>
                            @foreach ($postes as $poste)
                                <option value="{{ $poste->id }}" {{ in_array($poste->id, $attribution->postes->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $poste->designation_poste }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mt-3 col-12">
                    <div class="form-group">
                        <label for="peripheriques">Périphériques</label>
                        <select name="peripheriques[]" id="peripheriques" class="js-example-basic-multiple form-control" multiple required>
                            @foreach ($peripheriques as $peripherique)
                                <option value="{{ $peripherique->id }}" {{ in_array($peripherique->id, $attribution->peripheriques->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $peripherique->nom_peripherique }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="col-12 mt-3">
                    <label for="date_attribution" class="form-label">Date d'attribution</label>
                    <input type="date" name="date_attribution" class=" form-control" id="date_attribution" value="{{ $attribution->date_attribution->format('Y-m-d') }}" required>
                </div>


                <div class="mt-3 d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    <a href="{{ route('attributions.index') }}" class="btn btn-secondary">Annuler</a>
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
