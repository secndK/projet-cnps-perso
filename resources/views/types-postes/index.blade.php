@extends('layouts.app')

@section('title', ' Types de postes')

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
                <thead class="bg-primary text-white">
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
                        <td>{{ $type->id }}</td>
                        <td>{{ $type->libelle_type }}</td>
                        <td>{{ $type->created_at->format('d/m/Y H:i') }}</td>
                        <td>{{ $type->updated_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <a href="{{ route('types-postes.show') }}" class="btn btn-info btn-sm">Visualiser</a>
                            <a href="{{route('types-postes.edit')  }}" class="btn btn-primary btn-sm">Éditer</a>
                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteTypePosteModal{{ $type->id }}">
                                Supprimer
                            </button>
                        </td>
                    </tr>
                     @include('types-postes.modals.delete', ['type' => $type])
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">Aucun type de poste trouvé.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
