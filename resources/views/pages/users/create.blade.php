@extends('layouts.app')

@section('title', 'Créer un Utilisateur')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<div class="card">
    <div class="card-header">
        <h3>Créer un nouvel Utilisateur</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('users.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="mt-3 col-6">
                    <label for="matriculeAgent" class="form-label">Matricule de l'utilisateur</label>
                    <input type="text" name="matricule_agent" class="form-control" id="matriculeAgent" value="{{ old('matricule_agent') }}" required>
                </div>

                <div class="mt-3 col-6">
                    <label for="usersName" class="form-label">Nom de l'utilisateur</label>
                    <input type="text" name="name" class="form-control" id="usersName" value="{{ old('name') }}"   required>
                </div>
                <div class="mt-3 col-6 ">
                    <label for="prenomAgent" class="form-label">Prenom de l'utilisateur</label>
                    <input type="text" name="prenom_agent" class="form-control" id="prenomAgent" value="{{ old('prenom_agent') }}"  required>
                </div>

                <div class="mt-3 col-6">
                    <label for="usersEmail" class="form-label">Email de l'utilisateur</label>
                    <input type="email" name="email" class="form-control" id="usersEmail" value="{{ old('email') }}"  required>
                </div>



                <div class="mt-3 col-6">
                    <label for="directionAgent" class="form-label">Direction de l'utilisateur</label>
                    <input type="text" name="direction_agent" class="form-control" id="directionAgent" value="{{ old('direction_agent') }}"  required>
                </div>

                <div class="mt-3 col-6">
                    <label for="directionAgent" class="form-label">Localisation de l'utilisateur</label>
                    <input type="text" name="localisation_agent" class="form-control" id="localisationAgent" value="{{ old('localisation_agent') }}"  required>
                </div>

                <div class="mt-3 col-6">
                    <label for="usersPassword" class="form-label">Mot de passe</label>
                    <input type="password" name="password" class="form-control" id="usersPassword">
                    <small class="form-text text-muted">Laissez vide pour ne pas modifier le mot de passe.</small>
                </div>

                <div class="mt-3 col-6">
                    <label for="usersRoles" class="form-label">Rôle</label>
                    <select name="role_id" id="usersRoles" class="form-select" required>
                        <option value="">Sélectionnez un rôle</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" >
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mt-3 col-6">
                    <label  class="form-label">Confirmer Mot de passe</label>
                    <input type="password" name="password_confirmation" required class="form-control">
                </div>
            </div>

            <div class="mt-3 d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Valider</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>

@endsection


