@extends('layouts.app')

@section('title', 'Détails du Rôle')
@section('voidgrubs')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Rôles</a></li>
    <li class="breadcrumb-item active" aria-current="page">Détails de rôle</li>
  </ol>
</nav>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Visualiser le rôle</h3>
    </div>
    <div class="card-body">
        <!-- Affichage des informations sur le rôle -->
        <form>
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nom du rôle</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $role->name }}" disabled>
            </div>

            <!-- Liste des permissions associées dans un tableau -->
            <div class="mb-3">
                <label class="form-label">Permissions attribuées</label>
                <div class="table-responsive">
                    @if($role->permissions->isEmpty())
                        <p class="text-muted">Aucune permission attribuée à ce rôle.</p>
                    @else
                        <table class="table table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>Permission</th>
                                    <th>Guard Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($role->permissions as $permission)
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input
                                                    type="checkbox"
                                                    class="form-check-input"
                                                    id="permission-{{ $permission->id }}"
                                                    checked
                                                    disabled
                                                >
                                                <label class="form-check-label" for="permission-{{ $permission->id }}">
                                                    {{ $permission->name }}
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <span>{{ $permission->guard_name }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>

            <!-- Bouton de retour -->
            <a href="{{ route('roles.index') }}" class="btn btn-secondary">Retour</a>
        </form>
    </div>
</div>
@endsection
