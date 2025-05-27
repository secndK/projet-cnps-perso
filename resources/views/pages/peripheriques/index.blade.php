@extends('layouts.app')

@section('title', 'Gestion des périphériques')

@section('voidgrubs')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">Périphériques</li>
  </ol>
</nav>
@endsection

@section('content')
<div class="container">

    {{-- Formulaire de recherche --}}
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
                   placeholder=" Ex: En service, Réformé, etc."
                   value="{{ request('etat_statut') }}">
        </div>

        <div class="col-md-2">
            <label for="direction" class="form-label">Direction</label>
            <input type="text" name="direction" id="direction" class="form-control"
                   placeholder="Ex : DSI, DRH, COMPTA"
                   value="{{ request('direction') }}">
        </div>

        <div class="col-md-2">
            <label for="type" class="form-label">Type de périphérique</label>
            <select name="type" id="type" class="form-select">
                <option value="">Tous</option>
                @foreach ($types as $type)
                    <option value="{{ $type->libelle_type }}" {{ request('type') == $type->libelle_type ? 'selected' : '' }}>
                        {{ $type->libelle_type }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="gap-2 col-md-2 d-flex">
            <button type="submit" class="mt-4 btn btn-outline-success">
                <i class="bi bi-search"></i>
            </button>
            <a href="{{ route('peripheriques.index') }}" class="mt-4 btn btn-outline-danger">
                <i class="bi bi-arrow-counterclockwise"></i>
            </a>
        </div>

        <div class="col-md-2">
            @can('create-peripherique')
                <a href="{{ route('peripheriques.create') }}" class="btn btn-secondary">Créer un périphérique</a>
            @endcan
        </div>
    </form>

    {{-- Tableau des périphériques --}}
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
                    <th>Statut</th>
                    <th>Matricule proprietaire</th>
                    <th>Nom proprietaire</th>

                    <th>Direction</th>
                    <th>Localisation</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($peripheriques as $peripherique)
                <tr>
                    <td class="text-nowrap">{{ $loop->iteration + ($peripheriques->currentPage() - 1) * $peripheriques->perPage() }}</td>
                    <td class="text-nowrap">{{ $peripherique->num_serie_peripherique }}</td>
                    <td class="text-nowrap">{{ $peripherique->num_inventaire_peripherique }}</td>
                    <td class="text-nowrap">{{ $peripherique->nom_peripherique }}</td>
                    <td class="text-nowrap">{{ $peripherique->designation_peripherique ?? 'N/A' }}</td>
                    <td class="text-nowrap">{{ $peripherique->typePeripherique->libelle_type ?? 'Non défini' }}</td>
                    <td class="text-nowrap">{{ $peripherique->etat_peripherique ?? 'N/A' }}</td>
                    <td class="text-nowrap">
                        <span class="badge
                            {{ $peripherique->statut_peripherique === 'réformé' ? 'bg-danger' :
                               ($peripherique->statut_peripherique === 'en service' ? 'bg-success' :
                               ($peripherique->statut_peripherique === 'disponible' ? 'bg-warning' : 'bg-secondary')) }}">
                            {{ $peripherique->statut_peripherique }}
                        </span>
                    </td>

                    <td class="text-nowrap">{{ $peripherique->agent->matricule_agent ?? 'N/A' }}</td>
                    <td>{{ $peripherique->agent->nom_agent ?? 'N/A' }}</td>

                    <td class="text-nowrap"> {{ $peripherique->agent->direction_agent ?? 'N/A' }}</td>
                    <td class="text-nowrap">{{ $peripherique->agent->localisation_agent ?? 'N/A' }}</td>
                    <td class="text-nowrap">

                        @can('view-peripherique')

                            <a href="{{ route('peripheriques.show', $peripherique->id) }}" class="btn btn-outline-success btn-sm"><i class="bi bi-eye"></i></a>

                        @endcan

                        @if($peripherique->statut_peripherique !== 'réformé')

                            @can('edit-peripherique')
                                <a href="{{ route('peripheriques.edit', $peripherique->id) }}" class="btn btn-outline-primary btn-sm"><i class="bi bi-pencil"></i></a>
                            @endcan

                            @can('delete-peripherique')
                                <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deletePeripheriqueModal{{ $peripherique->id }}">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            @endcan

                            @else

                            @can('edit-peripherique')
                                <button class="btn btn-primary btn-sm disabled" aria-disabled="true"><i class="bi bi-pencil"></i></button>
                            @endcan

                            @can('delete-peripherique')
                            <button class="btn btn-danger btn-sm" disabled> <i class="bi bi-trash3"></i></button>
                            @endcan
                        @endif
                    </td>
                </tr>
                @include('pages.peripheriques.modals.delete', ['peripherique' => $peripherique])
                @empty
                <tr>
                    <td colspan="11" class="text-center text-muted">Aucun périphérique trouvé.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4 d-flex justify-content-start">
        {{ $peripheriques->appends(request()->query())->links() }}
    </div>
</div>
@endsection

@section('style')
<style>
    .btn {
        box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.9s ease 0s;
        cursor: pointer;
        outline: none;
    }
</style>
@endsection
