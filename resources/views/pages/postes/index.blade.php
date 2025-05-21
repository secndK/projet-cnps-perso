@extends('layouts.app')

@section('title', 'Gestion des postes de travail')
@section('module', 'poste de travail')

@section('content')
<br>
<br>
<div class="card">
    <div class="card-header bg-light d-flex justify-content-start align-items-center">
        <div>
            <a href="{{ route('postes.create') }}" class="btn btn-primary">Créer un poste de travail</a>
        </div>
    </div>

    <div class="card-body">
        <table id="tablepostetravail" class="table datatable table-responsive">
            <thead class="bg-primary text-white">
                <tr>
                    <th scope="col">N°</th>
                    <th >N° série</th>
                    <th>N° inventaire</th>
                    <th>Nom</th>
                    <th>Désignation</th>
                    <th>Type</th>
                    <th>État</th>
                    <th>Statut</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($postes as $poste)
                    <tr><td scope="row">{{ $loop->index + 1 }}</td>
                        <td>{{ $poste->num_serie_poste }}</td>
                        <td>{{ $poste->num_inventaire_poste}}</td>
                        <td>{{ $poste->nom_poste}}</td>
                        <td>{{ $poste->designation_poste }}</td>
                        <td>{{ $poste->TypePoste->libelle_type ?? 'Non défini' }}</td>
                        <td>
                            @if($poste->etat_poste === 'Réformé')
                                <span class="badge bg-danger">{{ 'Réformé' }}</span>
                            @elseif($poste->etat_poste === 'En service')
                                <span class="badge bg-success">{{ 'En service' }}</span>
                            @elseif($poste->etat_poste === 'En panne')
                                <span class="badge bg-warning">{{ 'En panne' }}</span>
                            @else
                                <span class="badge bg-secondary">{{ 'N/A' }}</span>
                            @endif
                        </td>
                        <td>{{ $poste->statut_poste}}</td>
                        <td>
                            @if($poste->etat_poste === 'Réformé')
                            <a href="{{ route('postes.show', $poste->id) }}" class="btn btn-info btn-sm">Visualiser</a>
                            <a href="#" class="btn btn-secondary btn-sm disabled" aria-disabled="true">Éditer</a>
                            <button class="btn btn-secondary btn-sm" disabled>Supprimer</button>
                        @else
                            <a href="{{ route('postes.show', $poste->id) }}" class="btn btn-info btn-sm">Visualiser</a>
                            <a href="{{ route('postes.edit', $poste->id) }}" class="btn btn-primary btn-sm">Éditer</a>
                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deletePosteModal{{ $poste->id }}">
                                Supprimer
                            </button>
                        @endif

                        </td>

                    </tr>
                    @include('pages.postes.modals.delete', ['poste' => $poste])
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">Aucun poste de travail trouvé.</td>
                    </tr>
                @endforelse


            </tbody>
        </table>

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
