@extends('layouts.app')

@section('title', 'Poste de travail')

@section('content')

<br>
<br>

<div class="card">
    <div class="card-header bg-light d-flex justify-content-start align-items-center">
        <div>
            <a href="{{ route('poste_travail.create') }}" class="btn btn-primary">Créer un poste de travail</a>
        </div>
    </div>

    <div class="card-body">
        <table id="tablepostetravail" class="table datatable">
            <thead class="bg-primary text-white">
                <tr>
                    <th >N° série</th>
                    <th>N° inventaire</th>
                    <th >Périphérique</th>
                    <th>Nom</th>
                    <th>Désignation</th>
                    <th>Type</th>
                    <th>État</th>
                    <th width="25%">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($poste as $pst)
                    <tr>
                        <td>{{ $pst->num_serie_poste_travail }}</td>
                        <td>{{ $pst->num_inventaire_poste_travail }}
                        <td>
                            <!-- Afficher les périphériques sous forme de badges -->
                            @if ($pst->peripheriques->count() > 0)
                                @foreach ($pst->peripheriques as $peripherique)
                                    @if($peripherique->nom_peripherique == 'Clavier')
                                    <span class="badge bg-warning me-1"><i class="bi bi-keyboard"></i> {{ $peripherique->designation_peripherique }}</span>
                                    @elseif ($peripherique->nom_peripherique == 'Souris')
                                    <span class="badge bg-warning me-1"><i class="bi bi-mouse3-fill"></i> {{ $peripherique->designation_peripherique }}</span>
                                    @else($peripherique->nom_peripherique == 'Ecran')
                                    <span class="badge bg-warning me-1"><i class="bi bi-tv"></i> {{ $peripherique->designation_peripherique }}</span>
                                    @endif
                                @endforeach
                            @else
                                <span class="text-muted">Aucun périphérique</span>
                            @endif
                        </td>
                        <td>{{ $pst->nom_poste_travail }}</td>
                        <td>{{ $pst->designation_poste_travail }}</td>
                        <td>{{ $pst->type_poste_travail }}</td>
                        <td>{{ $pst->etat_poste_travail }}</td>
                        <td>
                            <a href="{{ route('poste_travail.show', $pst->id) }}" class="btn btn-info btn-sm">Visualiser</a>
                            <a href="{{ route('poste_travail.edit', $pst->id) }}" class="btn btn-primary btn-sm">Éditer</a>
                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deletePosteTravailModal{{ $pst->id }}">
                                Supprimer
                            </button>
                        </td>
                    </tr>
                    @include('poste_travail.modals.delete', ['pst' => $pst])

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
    });
</script>
@endsection
