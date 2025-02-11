@extends('layouts.app')

@section('title', 'Détails du type de postes')

@section('content')

<div class="card">
    <div class="card-header">
        <h3>Détails de l'utilisateur</h3>
    </div>
    <div class="card-body">
        <form>
            <div class="mt-3 row">
                <div class="mt-3 col-12">
                    <div class="form-group">
                        <label for="libelleType" class="form-label"> Libelle du type</label>
                        <input type="text" class="form-control" id="u" readonly value="{{ $types->libelle_type}}" disabled>
                    </div>
                </div>
            </div>
        </form>
        <div class="mt-3 d-flex justify-content-start">
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Retour à la liste</a>
        </div>
    </div>
</div>




@endsection
