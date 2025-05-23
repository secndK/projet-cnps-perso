@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Historique global des actions sur les postes</h3>


    <div class="table-responsive">
        <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Action Réalisée</th>
                <th>Numero d'inventaire</th>
                <th>Numero de serie </th>
                <th>Désignation du poste</th>
                <th>Statut du poste</th>
                <th>Auteur de l'action</th>
                <th>Chronologie</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($historiques as $log)
                <tr>
                    <td>{{ $log->action_type }}</td>
                    <td>{{ $log->poste->num_inventaire_poste ?? 'Poste inconnu' }}</td>
                    <td>{{ $log->poste->num_serie_poste ?? 'Poste inconnu' }}</td>
                    <td>{{ $log->poste->designation_poste ?? 'Poste inconnu' }}</td>

                   <td>{{ $log->poste->statut_poste ?? 'Poste inconnu' }}</td>
                    <td>{{ $log->user->name.' '.$log->user->prenom_agent ?? 'Utilisateur inconnu' }}</td>
                    <td>{{ $log->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Aucune action enregistrée.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    </div>



    <a href="{{ route('postes.index') }}" class="btn btn-primary">Retour à la liste</a>
</div>
@endsection
