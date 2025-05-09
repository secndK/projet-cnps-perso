@extends('layouts.app')

@section('title', 'Roles')

@section('content')
<br><br>

<!-- Tableau des rôles -->
<div class="card">
    <div class="card-header bg-light d-flex justify-content-start align-items-center">
        <div>
            <a href="{{ route('roles.create') }}" class="btn btn-primary">Créer un rôle</a>
        </div>
    </div>
    <div class="card-body">
        <table id="tableRoles" class="table datatable">
            <thead class="bg-primary text-white">
                <tr>
                    <th width="1%">No</th>
                    <th>Nom du rôle</th>
                    <th width="25%">Permissions</th> <!-- Nouvelle colonne pour les permissions -->
                    <th>Créé le</th>
                    <th>Mis à jour le</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($roles as $key => $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td>
                            <!-- Afficher les permissions sous forme de badges -->
                            @if ($role->permissions->count() > 0)
                                @foreach ($role->permissions as $permission)
                                    <span class="badge bg-warning me-1">{{ $permission->name }}</span>
                                @endforeach
                            @else
                                <span class="text-muted">Aucune permission</span>
                            @endif
                        </td>
                        <td>{{ $role->created_at->format('d/m/Y H:i') }}</td>
                        <td>{{ $role->updated_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <a href="{{ route('roles.show', $role->id) }}" class="btn btn-info btn-sm">Visualiser</a>
                            <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary btn-sm">Éditer</a>
                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteRoleModal{{ $role->id }}">
                                Supprimer
                            </button>
                        </td>
                    </tr>
                    @include('pages.roles.modals.delete', ['role' => $role])
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Aucun rôle trouvé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
{{-- Script pour initialisation de la datatable --}}
@section('script')
<script>
    $(document).ready(function () {
        $('.datatable').DataTable();
    });
</script>
@endsection
