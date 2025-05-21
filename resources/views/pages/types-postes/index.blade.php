@extends('layouts.app')


@section('title', 'Gestion des postes de travail')
@section('module', 'Types de poste')

@section('content')

<div class="card">
    <div class="card">
        <div class="card-header bg-light d-flex justify-content-start align-items-center">
            <div>
                <a href="{{ route('types-postes.create') }}" class="btn btn-primary">Ajouter un type de poste</a>
            </div>
        </div>
        <div class="card-body">
            <table id="tabletype" class="table datatable">
                <thead class="text-white bg-primary">
                    <tr>
                        <th >N°</th>
                        <th >libelle type</th>
                        <th>crée le </th>
                        <th>mis à jour le </th>
                        <th >Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($types as $type)
                    <tr>
                       <td scope="row">{{ $loop->index + 1 }}</td>
                        <td>{{ $type->libelle_type }}</td>
                        <td>{{ $type->created_at->format('d/m/Y H:i') }}</td>
                        <td>{{ $type->updated_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <a href="{{ route('types-postes.show', $type->id) }}" class="btn btn-info btn-sm">Visualiser</a>
                            <a href="{{route('types-postes.edit', $type->id)  }}" class="btn btn-primary btn-sm">Éditer</a>
                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteTypePosteModal{{ $type->id }}">
                                Supprimer
                            </button>
                        </td>
                    </tr>
                     @include('pages.types-postes.modals.delete', ['type' => $type])
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">Aucun type de poste trouvé.</td>
                    </tr>
                    @endforelse

                </tbody>

            </table>

            <div class="mt-3 d-flex justify-content-end">

                <a href="{{ route('postes.index') }}" class="btn btn-secondary btn-sm"> Aller à la rubrique poste de travail </a>

            </div>
        </div>

    </div>

</div>

@endsection

@section('script')
<script>
    $(document).ready(function () {
        $('.datatable').DataTable();
        responsive: true
    });
</script>
@endsection
