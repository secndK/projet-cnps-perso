@extends('layouts.app')

@section('title', 'Éditer Rôle')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Éditer le rôle</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('roles.update', $role->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Champ pour le nom du rôle -->
            <div class="mb-3">
                <label for="roleName" class="form-label">Nom du rôle</label>
                <input type="text" name="name" class="form-control" id="roleName" value="{{ $role->name }}" required>
            </div>

            <!-- Tableau des permissions -->
            <div class="mb-3">
                <label class="form-label">Permissions</label>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="table-dark text-white">
                            <tr>
                                <th scope="col" width="1%">
                                    <!-- Case à cocher pour sélectionner/désélectionner tout -->
                                    <div class="form-check">
                                        <input
                                            type="checkbox"
                                            class="form-check-input"
                                            id="select-all-permissions"
                                            onchange="toggleAllPermissions(this)"
                                        >
                                    </div>
                                </th>
                                <th scope="col">Permission</th>
                                <th scope="col"  width="20%">Guard Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $permission)
                                <tr>
                                    <td>
                                        <!-- Case à cocher pour chaque permission -->
                                        <div class="form-check">
                                            <input
                                                type="checkbox"
                                                name="permissions[]"
                                                class="form-check-input permission-checkbox"
                                                id="permission-edit-{{ $permission->id }}"
                                                value="{{ $permission->id }}"
                                                {{ $role->permissions->contains($permission) ? 'checked' : '' }}
                                                onchange="updateSelectAllCheckbox()"
                                            >
                                        </div>
                                    </td>
                                    <td>
                                        <label class="form-check-label" for="permission-edit-{{ $permission->id }}">
                                            {{ $permission->name }}
                                        </label>
                                    </td>
                                    <td>
                                        <span>{{ $permission->guard_name }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Boutons d'action -->
            <div class="d-flex justify-content-between">
                <a href="{{ route('roles.index') }}" class="btn btn-secondary">Annuler</a>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Fonction pour sélectionner/désélectionner toutes les permissions
    function toggleAllPermissions(selectAllCheckbox) {
        const checkboxes = document.querySelectorAll('.permission-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = selectAllCheckbox.checked;
        });
    }

    // Fonction pour mettre à jour l'état de la case "Tout sélectionner"
    function updateSelectAllCheckbox() {
        const checkboxes = document.querySelectorAll('.permission-checkbox');
        const selectAllCheckbox = document.getElementById('select-all-permissions');

        // Vérifie si toutes les cases sont cochées
        const allChecked = Array.from(checkboxes).every(checkbox => checkbox.checked);

        // Met à jour l'état de la case "Tout sélectionner"
        selectAllCheckbox.checked = allChecked;
    }

    // Initialisation : vérifie l'état de la case "Tout sélectionner" au chargement de la page
    document.addEventListener('DOMContentLoaded', () => {
        updateSelectAllCheckbox();
    });
</script>
@endsection
