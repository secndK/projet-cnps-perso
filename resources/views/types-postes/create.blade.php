@extends('layouts.app')

@section('title', 'Créer un type de poste')

@section('content')
<div class="card">

    <div class="card-header">

        <h3>Créer un nouveau type de poste</h3>

    </div>

    <div class="card-body">

        <form action="{{ route('types-postes.store') }}" method="POST">

            @csrf

            <div class="col-12 mt-3">

                <label for="libelle_type" class="form-label">Libellé du type</label>
                <input type="text" name="libelle_type" class="form-control" id="libelle_type" required>

            </div>

            <div class="mt-3">

                <button type="submit" class="btn btn-primary">Créer</button>
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Retour</a>

            </div>

        </form>


    </div>
</div>
@endsection
