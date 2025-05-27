@extends('layouts.app')

@section('title', 'Gestion des postes de travail')

@section('voidgrubs')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">Postes de travail</li>
  </ol>
</nav>
@endsection

@section('content')
<div class="container">
    <form method="GET" class="mb-4 row g-4 align-items-end">
        <div class="col-md-2">
            <label for="numero" class="form-label">N° Série ou Inventaire</label>
            <input type="text" name="numero" id="numero" class="form-control"
                   placeholder="Série ou Inventaire"
                   value="{{ request('numero') }}">
        </div>


        <div class="col-md-2">
            <label for="etat_statut" class="form-label">État ou Statut</label>
            <input type="text" name="etat_statut" id="etat_statut" class="form-control"
                   placeholder=" Ex: En service, Attribué, etc."
                   value="{{ request('etat_statut') }}">
        </div>

        <div class="col-md-2">
            <label for="direction" class="form-label">Direction</label>
            <input type="text" name="direction" id="direction" class="form-control"
                   placeholder="Ex : DSI, DRH, COMPTA"
                   value="{{ request('direction') }}">
        </div>

        <div class="gap-2 col-md-2 d-flex">
            <button type="submit" class="mt-4 btn btn-outline-success">
                <i class="bi bi-search"></i>
            </button>
            <a href="{{ route('postes.index') }}" class="mt-4 btn btn-outline-danger">
                <i class="bi bi-arrow-counterclockwise"></i>
            </a>
        </div>

        <div class="col-md-2">
            @can('create-poste')
                <a href="{{ route('postes.create') }}" class="btn btn-secondary">Créer un poste</a>
            @endcan
        </div>
    </form>

    {{-- Tableau responsive --}}
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="text-white bg-primary">
                <tr>
                    <th>N°</th>
                    <th>N° série</th>
                    <th>N° inventaire</th>
                    <th>Nom</th>
                    <th>Désignation</th>
                    <th>Type</th>
                    <th>État</th>
                    <th>Matricule propriétaire</th>
                    <th>Nom propriétaire</th>
                    <th>Statut</th>
                    <th>Direction</th>
                    <th>Localisation</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($postes as $poste)
                    <tr>
                        <td >{{ $loop->iteration + ($postes->currentPage() - 1) * $postes->perPage() }}</td>
                        <td class="text-nowrap">{{ $poste->num_serie_poste }}</td>
                        <td class="text-nowrap">{{ $poste->num_inventaire_poste }}</td>
                        <td class="text-nowrap">{{ $poste->nom_poste }}</td>
                        <td class="text-nowrap">{{ $poste->designation_poste }}</td>
                        <td class="text-nowrap">{{ $poste->TypePoste->libelle_type ?? 'Non défini' }}</td>
                        <td class="text-nowrap">{{ $poste->etat_poste }}</td>
                        <td class="text-nowrap">
                            <span class="badge
                                {{ $poste->statut_poste== 'réformé' ? 'bg-danger' :
                                   ($poste->statut_poste === 'en service' ? 'bg-success' :
                                   ($poste->statut_poste === 'disponible' ? 'bg-warning' : 'bg-secondary')) }}">
                                {{ $poste->statut_poste }}
                            </span>
                        </td>
                        <td class="text-nowrap">{{ $poste->agent->matricule_agent ?? 'N/A' }}</td>
                        <td class="text-nowrap">{{ $poste->agent->nom_agent ?? 'N/A' }}</td>
                        <td class="text-nowrap">{{ $poste->agent->direction_agent ?? 'N/A' }}</td>
                        <td class="text-nowrap">{{ $poste->agent->localisation_agent ?? 'N/A' }}</td>
                        <td class="text-nowrap">

                            @can('view-poste')
                                <a href="{{ route('postes.show', $poste->id) }}" class="btn btn-outline-success btn-sm"><i class="bi bi-eye"></i></a>
                            @endcan

                            @if($poste->etat_poste !== 'Réformé')

                            @can('edit-poste')

                                <a href="{{ route('postes.edit', $poste->id) }}" class="btn btn-outline-primary btn-sm"><i class="bi bi-pencil"></i></a>
                            @endcan

                            @can('delete-poste')
                                <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deletePosteModal{{ $poste->id }}">
                                    <i class="bi bi-trash3"></i>
                                </button>

                            @endcan

                            @else

                            @can('edit-poste')
                                <button class="btn btn-primary btn-sm disabled" aria-disabled="true"><i class="bi bi-pencil"></i></button>
                            @endcan

                            @can('delete-poste')
                                <button class="btn btn-danger btn-sm" disabled> <i class="bi bi-trash3"></i></button>
                            @endcan

                            @endif
                        </td>
                    </tr>
                    @include('pages.postes.modals.delete', ['poste' => $poste])
                @empty
                    <tr>
                        <td colspan="11" class="text-center text-muted">Aucun poste de travail trouvé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4 d-flex justify-content-start">
        {{ $postes->appends(request()->query())->links() }}
    </div>
</div>
@endsection



@section('style')

<style>
    .btn{
        box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.9s ease 0s;
        cursor: pointer;
        outline: none;
    }

</style>

@endsection
