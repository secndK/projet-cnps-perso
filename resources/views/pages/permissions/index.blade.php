@extends('layouts.app')

@section('title', 'Permissions')

@include('pages.permissions.modals.create')

@section('content')

<br>
<br>


    <!-- Tableau des permissions -->
    <div class="card">
        <div class="card-header bg-light d-flex justify-content-start align-items-center">
            <div>
                <a href="{{ route('permissions.create') }}" class="btn btn-primary">Créer une permission</a>
            </div>
        </div>
        <div class="card-body">

                <table id="tablePermissions" class="table datatable">
                    <thead class="text-white ">
                        <tr>
                            <th width="1%">No</th>
                            <th>Nom de la permission</th>
                            <th>Guard Name</th>
                            <th>Créé le</th>
                            <th>Mis à jour le</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($permissions as $key => $permission)
                            <tr>
                                <td scope="row">{{ $loop->index + 1 }}</td>
                                <td>{{ $permission->name }}</td>
                                <td>
                                    <span class="badge bg-success">{{ $permission->guard_name }}</span>
                                </td>
                                <td>{{ $permission->created_at->format('d/m/Y H:i') }}</td>
                                <td>{{ $permission->updated_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('permissions.show', $permission->id) }}" class="btn btn-info btn-sm">Visualiser</a>
                                    <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-primary btn-sm">Éditer</a>
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deletePermissionModal{{ $permission->id }}">
                                        Supprimer
                                    </button>
                                </td>
                            </tr>

                            {{-- @include('permissions.modals.view', ['permission' => $permission])
                            @include('permissions.modals.edit', ['permission' => $permission]) --}}
                            @include('pages.permissions.modals.delete', ['permission' => $permission])
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Aucune permission trouvée.</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>

        </div>
    </div>


@endsection

{{-- initialisation script datatable --}}
@section('script')
<script>
    $(document).ready(function () {
        $('.datatable').DataTable();
        responsive: true
    });
</script>
@endsection

