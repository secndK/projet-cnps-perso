@extends('layouts.app')

@section('title', 'Gestion des rôles')
@section('module', 'Rôles')

@section('voidgrubs')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">

    <li class="breadcrumb-item active" aria-current="page">Rôle</li>
  </ol>
</nav>
@endsection

@section('content')



<div class="container">
    <form method="GET" class="mb-4 row g-4 align-items-end">
    <div class="col-md-2">
        <label for="search" class="form-label">Rôle</label>
        <input type="text" name="search" id="search" class="form-control" placeholder="Ex: admin"
               value="{{ request('search') }}">
    </div>

    <div class="col-md-2">
        <label for="permission" class="form-label">Permission</label>
        <input type="text" name="permission" id="permission" class="form-control" placeholder="Ex: edit-users"
               value="{{ request('permission') }}">
    </div>

    <div class="col-md-2">
        <label for="created_from" class="form-label">Créé à partir du</label>
        <input type="date" name="created_from" id="created_from" class="form-control"
               value="{{ request('created_from') }}">
    </div>

    <div class="col-md-2">
        <label for="created_to" class="form-label">Jusqu'au</label>
        <input type="date" name="created_to" id="created_to" class="form-control"
               value="{{ request('created_to') }}">
    </div>

    <div class="gap-2 col-md-2 d-flex">
        <button type="submit" class="btn btn-outline-success"><i class="bi bi-search"></i></button>
        <a href="{{ route('roles.index') }}" class="btn btn-outline-danger"><i class="bi bi-arrow-counterclockwise"></i></a>
    </div>

    <div class="col-md-2">
        <a href="{{ route('roles.create') }}" class="btn btn-secondary">Créer un rôle</a>
    </div>
</form>

<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead class="text-white bg-primary">
            <tr>
                <th scope="col">N°</th>
                <th>Nom du rôle</th>
                <th>Permissions</th>
                <th>Créé le</th>
                <th>Mis à jour le</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($roles as $role)
                <tr>
                    <td>{{ $loop->iteration + ($roles->currentPage() - 1) * $roles->perPage() }}</td>
                    <td>{{ $role->name }}</td>
                    <td>
                        @forelse ($role->permissions as $permission)
                            <span class="badge bg-warning me-1"><i class="bi bi-shield-lock"></i> {{ $permission->name }}</span>
                        @empty
                            <span class="text-muted">Aucune permission</span>
                        @endforelse
                    </td>
                    <td>{{ $role->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ $role->updated_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('roles.show', $role->id) }}" class="btn btn-outline-success btn-sm"><i class="bi bi-eye"></i></a>
                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-outline-primary btn-sm"><i class="bi bi-pencil"></i></a>
                        <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteRoleModal{{ $role->id }}">
                            <i class="bi bi-trash3"></i>
                        </button>
                    </td>
                </tr>
                @include('pages.roles.modals.delete', ['role' => $role])
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">Aucun rôle trouvé.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4 d-flex justify-content-start">
    {{ $roles->appends(request()->query())->links() }}
</div>
</div>


@endsection
