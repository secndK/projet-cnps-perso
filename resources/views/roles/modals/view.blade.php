<!-- Modal: View Role -->
<div class="modal fade" id="viewRoleModal{{ $role->id }}" tabindex="-1" aria-labelledby="viewRoleModalLabel{{ $role->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewRoleModalLabel{{ $role->id }}">Détails du rôle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Nom :</strong> {{ $role->name }}</p>
                <p><strong>Guard Name :</strong> {{ $role->guard_name }}</p>
                <p><strong>Permissions :</strong></p>
                <ul>
                    @foreach ($role->permissions as $permission)
                        <li>{{ $permission->name }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
