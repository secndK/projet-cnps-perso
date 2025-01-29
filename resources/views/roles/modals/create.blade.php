<!-- Modal: Create Role -->
<div class="modal fade" id="createRoleModal" tabindex="-1" aria-labelledby="createRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createRoleModalLabel">Créer un nouveau rôle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('roles.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <!-- Champ pour le nom du rôle -->
                    <div class="mb-3">
                        <label for="roleName" class="form-label">Nom du rôle</label>
                        <input type="text" name="name" class="form-control" id="roleName" required>
                    </div>
                    <!-- Liste des permissions en checkbox -->
                    <div class="mb-3">
                        <label class="form-label">Permissions</label>
                        <div>
                            @foreach ($permissions as $permission)
                                <div class="form-check">
                                    <input
                                        type="checkbox"
                                        name="permissions[]"
                                        class="form-check-input"
                                        id="permission-create-{{ $permission->id }}"
                                        value="{{ $permission->id }}"
                                    >
                                    <label class="form-check-label" for="permission-create-{{ $permission->id }}">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Boutons du modal -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Créer</button>
                </div>
            </form>
        </div>
    </div>
</div>
