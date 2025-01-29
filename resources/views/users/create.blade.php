@extends('layouts.app')

@section('title', 'Créer un Utilisateur')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Créer un nouvel Utilisateur</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="mt-3 row">

                <div class="col-6">

                    <div class="mb-3">
                        <label for="userName" class="form-label">Nom de l'utilisateur</label>
                        <input type="text" name="name" class="form-control" id="userName" required>
                    </div>

                </div>
                <div class="col-6">
                     <!-- Champ pour l'email de l'utilisateur -->
                    <div class="mb-3">
                        <label for="userEmail" class="form-label">Email de l'utilisateur</label>
                        <input type="email" name="email" class="form-control" id="userEmail" required>
                    </div>

                </div>
                <div class="col-6">

                    <div class="mb-3">
                        <label for="userPassword" class="form-label">Mot de passe</label>
                        <input type="password" name="password" class="form-control" id="userPassword" required>
                    </div>

                </div>

                <div class="col-6">

                    <div class="mb-3">
                        <label for="userRoles" class="form-label">Rôle</label>
                        <select name="role_id" id="userRoles" class="form-select" required>
                            <option value="">Sélectionnez un rôle</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="col-6">

                </div>

            </div>

            <!-- Boutons d'action -->
            <div class="mt-3 d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Créer</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Annuler</a>

            </div>
        </form>
    </div>
</div>

@endsection
