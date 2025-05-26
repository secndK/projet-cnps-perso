@extends('layouts.app')

@section('title', 'Créer un Utilisateur')

@section('voidgrubs')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Utilisateurs</a></li>
    <li class="breadcrumb-item active" aria-current="page">Création d'utilisateurs</li>
  </ol>
</nav>
@endsection

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
                    <label for="username" class="form-label">Identifiant     de l'utilisateur</label>
                    <input type="text" name="username" class="form-control" id="username" value="{{ old('username') }}" required>
                </div>

                <div class="mt-3 col-6">
                    <label for="name" class="form-label">Nom de l'utilisateur</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}"   required>
                </div>

                <div class="mt-3 col-6">
                    <label for="usersEmail" class="form-label">Email de l'utilisateur</label>
                    <input type="email" name="email" class="form-control" id="usersEmail" value="{{ old('email') }}"  required>
                </div>




                <div class="mt-3 col-6">
                    <label for="usersPassword" class="form-label">Mot de passe</label>
                    <input type="password" name="password" class="form-control" id="usersPassword">
                    <small class="form-text text-muted">Laissez vide pour ne pas modifier le mot de passe.</small>
                </div>
                <div class="mt-3 col-6">
                    <div class="form-group">
                        <label for="StatutUser" class="form-label">statut utilisateur</label>
                        <select name="statut_user" id="StatutUser" class="js-example-basic-single form-select" >
                            <option value="">-- Choisir --</option>
                            <option value="actif">Actif</option>
                            <option value="inactif">Inactif</option>
                        </select>
                    </div>
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


