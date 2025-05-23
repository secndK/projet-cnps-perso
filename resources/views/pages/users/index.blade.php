@extends('layouts.app')

@section('title', 'Gestion des Utilisateurs')
@section('module', 'Utilisateurs')
@section('voidgrubs')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">Utilisateurs</li>
  </ol>
</nav>
@endsection

@section('content')

<div class="container">
    <form method="GET" class="mb-4 row g-4 align-items-end">
    <div class="col-md-4">
        <label for="search" class="form-label">Rechercher un utilisateur</label>
        <input type="text" name="search" id="search" class="form-control" placeholder="Nom d'utilisateur ou email"
               value="{{ request('search') }}">
    </div>

    <div class="col-md-3">
        <label for="role" class="form-label">Filtrer par rôle</label>
        <select name="role" id="role" class="form-select">
            <option value="">-- Tous les rôles --</option>
            @foreach ($roles as $role)
                <option value="{{ $role->name }}" {{ request('role') == $role->name ? 'selected' : '' }}>
                    {{ $role->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="gap-2 col-md-2 d-flex">
        <button type="submit" class="btn btn-outline-success"><i class="bi bi-search"></i></button>
        <a href="{{ route('users.index') }}" class="btn btn-outline-danger"><i class="bi bi-arrow-counterclockwise"></i></a>
    </div>
    <div class="col-md-2">
        <a href="{{ route('users.create') }}" class="btn btn-secondary">Créer un utilisateur</a>
    </div>
</form>

<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead class="text-white bg-primary">
            <tr>
                <th scope="col">N°</th>
                <th scope="col">Matricule utilisateur</th>
                <th scope="col">Email</th>
                <th scope="col">Rôles</th>
                <th scope="col">Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse($users as $user)
            <tr>
                <td>{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @forelse ($user->roles as $role)
                        <span class="badge bg-info"><i class="bi bi-person-badge"></i> {{ $role->name }}</span>
                    @empty
                        <span class="text-muted">Aucun rôle</span>
                    @endforelse
                </td>
                <td>
                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-outline-success btn-sm"><i class="bi bi-eye"></i></a>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-outline-primary btn-sm"><i class="bi bi-pencil"></i></a>
                    <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteUserModal{{ $user->id }}"><i class="bi bi-trash3"></i></button>
                </td>
            </tr>

            @include('pages.users.modals.delete', ['user' => $user])
            @empty
            <tr>
                <td colspan="5" class="text-center text-muted">Aucun utilisateur trouvé.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4 d-flex justify-content-start">
    {{ $users->appends(request()->query())->links() }}
</div>
</div>



@endsection
