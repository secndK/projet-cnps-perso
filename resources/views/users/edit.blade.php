@extends('layouts.app')

@section('title', 'Éditer un Utilisateur')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Éditer l'utilisateur</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <!-- Champ pour le nom de l'utilisateur -->
            <div class="mb-3">
                <label for="usersName" class="form-label">Nom de l'utilisateur</label>
                <input type="text" name="name" class="form-control" id="usersName" value="{{ $user->name }}" required>
            </div>

            <!-- Champ pour l'email de l'utilisateur -->
            <div class="mb-3">
                <label for="usersEmail" class="form-label">Email de l'utilisateur</label>
                <input type="email" name="email" class="form-control" id="usersEmail" value="{{ $user->email }}" required>
            </div>
            <!-- Champ pour le mot de passe de l'utilisateur -->
            <div class="mb-3">
                <label for="usersPassword" class="form-label">Mot de passe</label>
                <input type="password" name="password" class="form-control" id="usersPassword">
                <small class="form-text text-muted">Laissez vide pour ne pas modifier le mot de passe.</small>
            </div>

            <!-- Liste déroulante pour les rôles (sélection unique) -->
            <div class="mb-3">
                <label for="usersRoles" class="form-label">Rôle</label>
                <select name="role_id" id="usersRoles" class="form-select" required>
                    <option value="">Sélectionnez un rôle</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}" {{ $user->roles->contains($role) ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Boutons d'action -->
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Mettre à jour</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Annuler</a>
                
            </div>
        </form>
    </div>
</div>

@endsection
