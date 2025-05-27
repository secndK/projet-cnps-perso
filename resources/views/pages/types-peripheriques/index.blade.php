@extends('layouts.app')

@section('title', 'Gestion des Périphériques')
@section('voidgrubs')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('types-peripheriques.index') }}">Type peripherique</a></li>

  </ol>
</nav>
@endsection

@section('content')

<div class="container mt-4">

    {{-- Formulaire de recherche --}}
    <form method="GET" class="row g-3 align-items-end">
        <div class="col-md-2">
            <label for="libelle" class="form-label">Libellé Type</label>
            <input type="text" name="libelle" id="libelle" class="form-control"
                   placeholder="Ex: Clavier, Souris" value="{{ request('libelle') }}">
        </div>

        <div class="col-md-2">
            <label for="created_at" class="form-label">Créé le</label>
            <input type="date" name="created_at" id="created_at" class="form-control"
                   value="{{ request('created_at') }}">
        </div>

        <div class="col-md-2">
            <label for="updated_at" class="form-label">Mis à jour le</label>
            <input type="date" name="updated_at" id="updated_at" class="form-control"
                   value="{{ request('updated_at') }}">
        </div>

        <div class="gap-2 col-md-2 d-flex">
            <button type="submit" class="mt-4 btn btn-outline-success">
                <i class="bi bi-search"></i>
            </button>
            <a href="{{ route('types-peripheriques.index') }}" class="mt-4 btn btn-outline-danger">
                <i class="bi bi-arrow-counterclockwise"></i>
            </a>
        </div>

        <div class="gap-2 col-md-4 d-flex">
            @can('create-type-peripherique')
                <a href="{{ route('types-peripheriques.create') }}" class="btn btn-secondary">Nouveau type</a>
            @endcan
            <a href="{{ route('peripheriques.index') }}" class="btn btn-light"><i class="bi bi-arrow-left"></i> Périphériques</a>
        </div>
    </form>

    {{-- Tableau des types de périphériques --}}
    <div class="mt-4 table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="text-white bg-primary">
                <tr>
                    <th>N°</th>
                    <th>Libellé Type</th>
                    <th>Créé le</th>
                    <th>Mis à jour le</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($types as $type)
                    <tr>
                        <td>{{ $loop->iteration + ($types->currentPage() - 1) * $types->perPage() }}</td>
                        <td>{{ $type->libelle_type }}</td>
                        <td>{{ $type->created_at->format('d/m/Y H:i') }}</td>
                        <td>{{ $type->updated_at->format('d/m/Y H:i') }}</td>
                        <td>

                            @can('view-type-peripherique')
                                <a href="{{ route('types-peripheriques.show', $type->id) }}" class="btn btn-outline-success btn-sm"><i class="bi bi-eye"></i></a>
                            @endcan


                            @can('edit-type-peripherique')
                                <a href="{{ route('types-peripheriques.edit', $type->id) }}" class="btn btn-outline-primary btn-sm"><i class="bi bi-pencil"></i></a>
                            @endcan


                            @can('delete-type-peripherique')
                                <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteTypePeripheriqueModal{{ $type->id }}">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            @endcan

                        </td>
                    </tr>
                    @include('pages.types-peripheriques.modals.delete', ['type' => $type])
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Aucun type de périphérique trouvé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4 d-flex justify-content-start">
        {{ $types->appends(request()->query())->links() }}
    </div>
</div>

@endsection

@section('style')
<style>
    .btn {
        box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease-in-out;
        cursor: pointer;
    }
</style>
@endsection
