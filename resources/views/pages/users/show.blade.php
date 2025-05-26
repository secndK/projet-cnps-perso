@extends('layouts.app')

@section('title', 'Détails de l\'Utilisateur')
@section('voidgrubs')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Utilisateurs</a></li>
    <li class="breadcrumb-item active" aria-current="page"> Détails d'utilisateur</li>
  </ol>
</nav>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Détails de l'utilisateur</h3>
    </div>
    <div class="card-body">
        <!-- Informations de l'utilisateur -->
        <form>
            <div class=" row">



                <div class="mt-3 col-6">
                    <div class="form-group">
                        <label for="usersName" class="form-label">Nom de l'utilisateur</label>
                        <input type="text" class="form-control" id="usersName" readonly value="{{ $user->name}}" disabled>
                    </div>
                </div>


                 <div class="mt-3 col-6">
                    <div class="form-group">
                        <label for="usersName" class="form-label">Matricule de l'utilisateur</label>
                        <input type="text" class="form-control" id="usersName" readonly value="{{ $user->username}}" disabled>
                    </div>
                </div>




                <div class="mt-3 col-6">
                    <div class="form-group">
                        <label for="usersEmail" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="usersEmail" readonly value="{{ $user->email}}" disabled>
                    </div>
                </div>


                <div class="mt-3 col-6">
                    <div class="form-group">
                        <label for="StatuUser" class="form-label">Statut de l'utilisateur</label>
                        <input type="text" class="form-control" id="StatutUser" readonly value="{{ $user->statut_user}}" disabled>
                    </div>
                </div>






                <div class="mt-3 col-6">
                    <div class="form-group">
                        <label for="usersCreatedAt" class="form-label">Créé le</label>
                        <input type="email" class="form-control" id="usersEmail" value="{{ $user->created_at}}" disabled>
                    </div>
                </div>

                <div class="mt-3 col-6">
                    <div class="form-group">
                        <label for="usersUpdatedAt" class="form-label">Mis à jour le :</label>
                        <input type="email" class="form-control" id="usersEmail" value="{{ $user->updated_at}}" disabled>
                    </div>
                </div>

                <div class="mt-3 col-12">
                    <div class="form-group">
                        <label for="usersRole" class="form-label">Rôle :</label>
                        <select class="form-select" id="usersRoles" disabled>
                            @if ($user->roles->count() > 0)
                                @foreach ($user->roles as $role)
                                    <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                                @endforeach
                            @else
                                <option value="">Aucun rôle attribué</option>
                            @endif
                        </select>                    </div>
                </div>
            </div>
        </form>
        <!-- Bouton de retour -->
        <div class="mt-3 d-flex justify-content-start">
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Retour à la liste</a>
        </div>
    </div>
</div>
@endsection
