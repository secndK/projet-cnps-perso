@extends('layouts.app')

@section('title', 'Periphériques')

@section('content')

<br>
<br>

<div class="card">

    <div class="card-header bg-light d-flex justify-content-start align-items-center">
        <div>
            <a href="{{ route('peripheriques.create') }}" class="btn btn-primary">Créer un périphérique</a>
        </div>
    </div>

    <div class="card-body">
        <table id="tableperipherique" class="table datatable">
            <thead class="bg-primary text-white">
                <tr>
                    {{-- <th>id</th> --}}
                    <th >N°série</th>
                    <th>N°inventaire</th>
                    <th >Nom</th> <!-- Nouvelle colonne pour les peripheriques -->
                    <th>Type</th>
                    <th>État</th>
                    <th >Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($peripheriques as $peripherique)
                <tr>
                    {{-- <td>{{ $peripherique->id }}</td> --}}
                    <td>{{ $peripherique->num_serie_peripherique }}</td>
                    <td>{{ $peripherique->num_inventaire_peripherique }}</td>
                    <td>{{ $peripherique->nom_peripherique. ' ' .$peripherique->designation_peripherique }}</td>
                    <td>{{ $peripherique->type_peripherique }}</td>
                    <td>{{ $peripherique->etat_peripherique }}</td>
                    <td>
                        <a href="{{ route('peripheriques.show', $peripherique->id) }}" class="btn btn-info btn-sm">Visualiser</a>
                        <a href="{{ route('peripheriques.edit', $peripherique->id) }}" class="btn btn-primary btn-sm">Éditer</a>
                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deletePeripheriqueModal{{ $peripherique->id }}">
                            Supprimer
                        </button>
                    </td>
                </tr>
                @include('peripherique.modals.delete', ['peripherique' => $peripherique])
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted">Aucun périphérique trouvé.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection
