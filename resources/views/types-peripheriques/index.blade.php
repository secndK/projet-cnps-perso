@extends('layouts.app')
@section('title', 'Gestion des Périphériques')
@section('module', 'Types de périphériques')

@section('content')
<div class="card">
    <div class="card-header bg-light d-flex justify-content-start align-items-center">
        <div>
            <a href="{{ route('types-peripheriques.create') }}" class="btn btn-primary">Créer un type de périphérique</a>
        </div>
    </div>
    <div class="card-body">
        <table id="tabletype" class="table datatable">
            <thead class="text-white bg-primary">
                <tr>
                    <th scope="col">N°</th>
                    <th>Libellé Type</th>
                    <th>Créé le</th>
                    <th>Mis à jour le</th>
                    <th>Action</th>
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
                        <a href="{{ route('types-peripheriques.show', $type->id) }}" class="btn btn-info btn-sm">Visualiser</a>
                        <a href="{{ route('types-peripheriques.edit', $type->id) }}" class="btn btn-primary btn-sm">Éditer</a>
                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteTypePeripheriqueModal{{ $type->id }}">
                            Supprimer
                        </button>
                    </td>
                </tr>
                @include('types-peripheriques.modals.delete', ['type' => $type])
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">Aucun type de poste trouvé.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
