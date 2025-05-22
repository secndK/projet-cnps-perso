@extends('layouts.app')

@section('title', 'Gestion des attributions')
@section('module', ' Historique')

@section('content')
<br>
<br>
<br>
<div class="container">
    {{-- <h1 class="mb-4">Historique des attributions</h1> --}}
        <form method="GET" class="row g-3 align-items-end mb-4">
            <div class="col-md-3">
                <label for="q" class="form-label">Recherche globale</label>
                <input type="text" name="q" id="q" class="form-control" placeholder="Nom, action, ID..." value="{{ request('q') }}">
            </div>
            <div class="col-md-3">
                <label for="from" class="form-label">Date début</label>
                <input type="date" name="from" id="from" class="form-control" value="{{ request('from') }}">
            </div>
            <div class="col-md-3">
                <label for="to" class="form-label">Date fin</label>
                <input type="date" name="to" id="to" class="form-control" value="{{ request('to') }}">
            </div>
            <div class="col-md-3">
                <label for="action" class="form-label">Type d'action</label>
                <select name="action" id="action" class="form-select">
                    <option value="">Tous</option>
                    <option value="Création" {{ (request('action') == 'Création') ? 'selected' : '' }}>Création</option>
                    <option value="Modification" {{ (request('action') == 'Modification') ? 'selected' : '' }}>Modification</option>
                    <option value="Retrait" {{ (request('action') == 'Retrait') ? 'selected' : '' }}>Retrait</option>
                    {{-- Ajoute d'autres types d'actions si nécessaire --}}
                </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-outline-success"><i class="bi bi-funnel"></i></button>
                <a href="{{ route('attributions.logs') }}" class="btn btn-outline-danger"><i class="bi bi-arrow-counterclockwise"></i></a>
            </div>
        </form>

        <div class="table-responsive">
                <table class="table table-bordered table-hover ">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Action réalisée</th>
                            <th>Auteur de l'action</th>
                            <th>Bénéficiaire </th>
                            <th>Attribution ID</th>
                            <th>Postes</th>
                            <th>Périphériques</th>
                            <th>Chrnonologie de l'action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($logs as $log)
                            <tr>
                                <td>{{ $log->id }}</td>
                                <td>{{ $log->action_type }}</td>

                                {{-- Auteur --}}
                                <td>{{ $users[$log->user_id]->name ?? 'Inconnu' }}</td>

                                {{-- Bénéficiaire --}}
                                <td>
                                    @if(isset($agents[$log->agent_id]))
                                        {{ $agents[$log->agent_id]->nom_agent }} {{ $agents[$log->agent_id]->prenom_agent }}
                                    @else
                                        Inconnu
                                    @endif
                                </td>

                                <td>{{ $log->attribution_id }}</td>

                                {{-- Postes --}}
                                <td>
                                    @php
                                        $postesIds = is_string($log->postes) ? json_decode($log->postes, true) : $log->postes;
                                    @endphp

                                    @if(!empty($postesIds) && is_array($postesIds))
                                        @foreach($postesIds as $posteId)
                                            @php $poste = \App\Models\Poste::find($posteId); @endphp
                                            <span class="badge bg-warning mb-1 d-inline-block">
                                                {{ $poste ? $poste->num_serie_poste . ' - ' . $poste->designation_poste : "Introuvable (ID: $posteId)" }}
                                            </span><br>
                                        @endforeach
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>

                                {{-- Périphériques --}}
                                <td>
                                    @php
                                        $peripheriquesIds = is_string($log->peripheriques) ? json_decode($log->peripheriques, true) : $log->peripheriques;
                                    @endphp

                                    @if(!empty($peripheriquesIds) && is_array($peripheriquesIds))
                                        @foreach($peripheriquesIds as $peripheriqueId)
                                            @php $peripherique = \App\Models\Peripherique::find($peripheriqueId); @endphp
                                            <span class="badge bg-warning text-dark mb-1 d-inline-block">
                                                {{ $peripherique ? $peripherique->num_serie_peripherique . ' - ' . $peripherique->designation_peripherique : "Introuvable (ID: $peripheriqueId)" }}
                                            </span><br>
                                        @endforeach
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>

                                <td>
                                    @php
                                        $date = $log->action_type === 'Création'
                                            ? \Carbon\Carbon::parse($log->created_at)->format('d/m/Y H:i')
                                            : \Carbon\Carbon::parse($log->updated_at)->format('d/m/Y H:i');
                                    @endphp

                                    {{ $date }}

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Aucun log trouvé.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

        </div>




    <div class="d-flex justify-content-start mt-4">
          {{ $logs->links() }}
    </div>

</div>
@endsection
