@extends('layouts.app')

@section('title', 'Modifier un Utilisateur')

@section('voidgrubs')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Utilisateurs</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edition d'utilisateurs</li>
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
        <h3>Modifier l'utilisateur</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">


                <div class="mt-3 col-6">
                    <label class="form-label">Nom</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="mt-3 col-6">
                    <label class="form-label">Matricule</label>
                    <input type="text" name="prenom_agent" class="form-control" value="{{ old('username', $user->username) }}" required>
                </div>

                <div class="mt-3 col-6">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                </div>


                <div class="mt-3 col-6">
                    <label class="form-label">Nouveau mot de passe</label>
                    <input type="password" name="password" class="form-control">
                    <small class="form-text text-muted">Laissez vide pour ne pas modifier le mot de passe.</small>
                </div>

                <div class="mt-3 col-6">
                    <label class="form-label">Rôle</label>
                    <select name="role_id" class="form-select" required>
                        {{-- <option value="">Sélectionnez un rôle</option> --}}
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-3 col-6">
                    <label class="form-label">Confirmer le mot de passe</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>
            </div>

            <div class="mt-3 d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Mettre à jour</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>

@endsection
