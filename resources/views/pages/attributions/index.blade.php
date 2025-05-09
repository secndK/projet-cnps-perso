@extends('layouts.app')
@section('title', 'Gestion des accès')
@section('module', ' Attribution')



@section('content')

<br>
<br>

<div class="card">
    <div class="card-header bg-light d-flex justify-content-start align-items-center">
        <div>
            <a href="{{ route('attributions.create') }}" class="btn btn-primary"> Nouvelle attribution</a>
        </div>
    </div>
    <div class="card-body">
        <table id="tableperipherique" class="table datatable">
            <thead class="text-white bg-primary">
                <tr>
                    <th scope="col">N°</th>
                    <th>Agent</th>
                    <th width="27%">Postes</th>
                    <th width="25%">Périphériques</th>
                    <th width="20%" >Action</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($attributions as $attribution)

                <tr><td scope="row">{{ $loop->index + 1 }}</td>

                    <td>{{ $attribution->user->name }}</td>
                    <td>
                        @foreach ($attribution->postes as $poste)
                        <span class="badge bg-warning"><i class="bi bi-laptop"></i> {{ $poste->nom_poste }}</span>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($attribution->peripheriques as $peripherique)
                        <span class="badge bg-warning"><i class="bi bi-mouse"></i>{{ $peripherique->nom_peripherique }}</span>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('attributions.show', $attribution) }}" class="btn btn-info btn-sm">Visualiser</a>
                        <a href="{{ route('attributions.edit', $attribution) }}" class="btn btn-primary btn-sm">Modifier</a>
                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteAttributionModal{{ $attribution->id }}">
                                Supprimer
                            </button>
                    </td>
                </tr>
                @include('pages.attributions.modals.delete', ['attribution' => $attribution])
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted">Aucun attribution.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
