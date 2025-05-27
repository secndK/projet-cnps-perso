@extends('layouts.app')

@section('title', 'Gestion des accès et rôles')



@section('voidgrubs')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">Permission</li>
  </ol>
</nav>
@endsection

@section('content')
<form method="GET" class="mb-4 row g-4 align-items-end">
    <div class="col-md-2">
        <label for="search" class="form-label">Nom de la permission</label>
        <input type="text" name="search" id="search" class="form-control" placeholder="ex: view-user" value="{{ request('search') }}">
    </div>

    <div class="col-md-2">
        <label for="guard" class="form-label">Guard name</label>
        <input type="text" name="guard" id="guard" class="form-control" placeholder="ex: guard" value="{{ request('guard') }}">
    </div>

    <div class="col-md-2">
        <label for="created_from" class="form-label">Créé à partir du</label>
        <input type="date" name="created_from" id="created_from" class="form-control" value="{{ request('created_from') }}">
    </div>

    <div class="col-md-2">
        <label for="created_to" class="form-label">Jusqu'au</label>
        <input type="date" name="created_to" id="created_to" class="form-control" value="{{ request('created_to') }}">
    </div>

    <div class="gap-2 col-md-2 d-flex">
        <button type="submit" class="btn btn-outline-success"><i class="bi bi-search"></i></button>
        <a href="{{ route('permissions.index') }}" class="btn btn-outline-danger"><i class="bi bi-arrow-counterclockwise"></i></a>
    </div>

    <div class="col-md-2">
        <a href="{{ route('permissions.create') }}" class="btn btn-secondary">Créer une permission</a>
    </div>
</form>

<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead class="text-white bg-primary">
            <tr>
                <th scope="col">N°</th>
                <th>Nom</th>
                <th>Guard</th>
                <th>Créé le</th>
                <th>Mis à jour le</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @forelse ($permissions as $permission)
            <tr>
                <td>{{ $loop->iteration + ($permissions->currentPage() - 1) * $permissions->perPage() }}</td>
                <td>{{ $permission->name }}</td>
                <td><span class="badge bg-success">{{ $permission->guard_name }}</span></td>
                <td>{{ $permission->created_at->format('d/m/Y H:i') }}</td>
                <td>{{ $permission->updated_at->format('d/m/Y H:i') }}</td>
                <td>
                    <a href="{{ route('permissions.show', $permission->id) }}" class="btn btn-outline-success btn-sm"><i class="bi bi-eye"></i></a>
                    <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-outline-primary btn-sm"><i class="bi bi-pencil"></i></a>
                    <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deletePermissionModal{{ $permission->id }}">
                        <i class="bi bi-trash3"></i>
                    </button>
                </td>
            </tr>

            @include('pages.permissions.modals.delete', ['permission' => $permission])
        @empty
            <tr>
                <td colspan="6" class="text-center text-muted">Aucune permission trouvée.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4 d-flex justify-content-start">
    {{ $permissions->appends(request()->query())->links() }}
</div>

@endsection
