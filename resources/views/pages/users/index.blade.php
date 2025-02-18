@extends('layouts.app')

@section('title', 'Gestion des Utilisateurs')

@section('content')

<div class="card">
    <div class="card-header">
        <div>
            <a href="{{ route('users.create') }}" class="btn btn-primary">Créer un utilisateur</a>
        </div>
    </div>

    <div class="card-body">
        <table id="tableUsers" class="table datatable">
            <thead class="text-white bg-primary">
                <tr>
                    <th width="1%">No</th>
                    <th>Nom de l'utilisateur</th>
                    <th>Email</th>
                    <th>Rôles</th> <!-- Nouvelle colonne pour les rôles -->
                    <th>Créé le</th>
                    <th>Mis à jour le</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse($users as $key => $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name}}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <!-- Afficher les rôles sous forme de badges -->
                        @if ($user->roles->count() > 0)
                            @foreach ($user->roles as $role)
                                <span class="badge bg-info me-1">{{ $role->name }}</span>
                            @endforeach
                        @else
                            <span class="text-muted">Aucun rôle</span>
                        @endif
                    </td>
                    <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ $user->updated_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-info btn-sm">Visualiser</a>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm">Éditer</a>
                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteUserModal{{ $user->id }}">
                            Supprimer
                        </button>
                    </td>
                </tr>

                @include('pages.users.modals.delete', ['user' => $user])

                @empty
                <tr>
                    <td colspan="7" class="text-center">Aucun utilisateur trouvé.</td>
                </tr>

                @endforelse
            </tbody>

        </table>
    </div>
</div>

@endsection

@section('script')
<script>
    $(document).ready(function () {
        $('.datatable').DataTable();
    });
</script>
@endsection
