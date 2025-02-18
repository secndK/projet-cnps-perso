<div class="modal fade" id="viewPermissionModal{{ $permission->id }}" tabindex="-1" aria-labelledby="viewPermissionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewPermissionModalLabel">Détails de la permission</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Nom :</strong> {{ $permission->name }}</p>
                <p><strong>Guard Name :</strong> {{ $permission->guard_name }}</p>
                <p><strong>Créé le :</strong> {{ $permission->created_at->format('d/m/Y H:i') }}</p>
                <p><strong>Mis à jour le :</strong> {{ $permission->updated_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>
    </div>
</div>
