@extends('layouts.app')

@section('title', 'Gestion des attributions')


@section('voidgrubs')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">Historique d'attribution</li>
  </ol>
</nav>
@endsection

@section('content')


<div class="container">
    {{-- <h1 class="mb-4">Historique des attributions</h1> --}}
        <form method="GET" class="mb-4 row g-3 align-items-end">
            <div class="col-md-3">
                <label for="q" class="form-label">Recherche globale</label>
                <input type="text" name="q" id="q" class="form-control" placeholder="Auteur, action, Bénéficiare..." value="{{ request('q') }}">
            </div>
            <div class="col-md-2">
                <label for="from" class="form-label">Date début</label>
                <input type="date" name="from" id="from" class="form-control" value="{{ request('from') }}">
            </div>
            <div class="col-md-2">
                <label for="to" class="form-label">Date fin</label>
                <input type="date" name="to" id="to" class="form-control" value="{{ request('to') }}">
            </div>
            <div class="col-md-2">
                <label for="action" class="form-label">Type d'action</label>
                <select name="action" id="action" class="form-select">
                    <option value="">Tous</option>
                    <option value="Création" {{ (request('action') == 'Création') ? 'selected' : '' }}>Création</option>
                    <option value="Modification" {{ (request('action') == 'Modification') ? 'selected' : '' }}>Modification</option>
                    <option value="Retrait" {{ (request('action') == 'Retrait') ? 'selected' : '' }}>Retrait</option>
                    {{-- Ajoute d'autres types d'actions si nécessaire --}}
                </select>
            </div>
            <div class="gap-2 col-md-2 d-flex">
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
                        <th>Bénéficiaire</th>
                        <th>Attribution ID</th>
                        <th>Postes</th>
                        <th>Périphériques</th>
                        <th>Chronologie de l'action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($logs as $log)
                        <tr>
                            <td>{{ $log->id }}</td>
                            <td>{{ $log->action_type }}</td>

                            {{-- Auteur --}}
                            <td>{{ $users[$log->user_id]->name ?? 'Inconnu' }} </td>

                            {{-- Bénéficiaire --}}
                            <td>
                                @if(isset($agents[$log->agent_id]))
                                    {{ $agents[$log->agent_id]->matricule_agent }}
                                @else

                                    Inconnu
                                @endif
                            </td>

                            <td>{{ $log->attribution_id }}</td>

                            {{-- Postes --}}
                            <td>
                                @if($log->action_type === 'Modification')
                                    {{-- Postes ajoutés --}}
                                    @php
                                        $postesAjoutes = is_string($log->postes_ajoutes) ? json_decode($log->postes_ajoutes, true) : $log->postes_ajoutes;
                                    @endphp
                                    @if(!empty($postesAjoutes))
                                        <div ><p class="fs-6"><strong>Ajoutés :</strong></p></div>
                                        @foreach($postesAjoutes as $posteId)
                                            @php $poste = \App\Models\Poste::find($posteId); @endphp
                                            <span class="mb-1 badge bg-success d-inline-block">
                                                {{ $poste ? $poste->num_serie_poste . ' - ' . $poste->designation_poste : "Introuvable (ID: $posteId)" }}
                                            </span><br>
                                        @endforeach
                                    @endif

                                    {{-- Postes retirés --}}
                                    @php
                                        $postesRetires = is_string($log->postes_retires) ? json_decode($log->postes_retires, true) : $log->postes_retires;
                                    @endphp
                                    @if(!empty($postesRetires))
                                        <div><strong>Retirés :</strong></div>
                                        @foreach($postesRetires as $posteId)
                                            @php $poste = \App\Models\Poste::find($posteId); @endphp
                                            <span class="mb-1 badge bg-danger d-inline-block">
                                                {{ $poste ? $poste->num_serie_poste . ' - ' . $poste->designation_poste : "Introuvable (ID: $posteId)" }}
                                            </span><br>
                                        @endforeach
                                    @endif

                                    @if(empty($postesAjoutes) && empty($postesRetires))
                                        <span class="text-muted">N/A</span>
                                    @endif
                                @else
                                    @php
                                        $postesIds = is_string($log->postes) ? json_decode($log->postes, true) : $log->postes;
                                    @endphp
                                    @if(!empty($postesIds))
                                        @foreach($postesIds as $posteId)
                                            @php $poste = \App\Models\Poste::find($posteId); @endphp
                                            <span class="mb-1 badge bg-warning d-inline-block">
                                                {{ $poste ? $poste->num_serie_poste . ' - ' . $poste->designation_poste : "Introuvable (ID: $posteId)" }}
                                            </span><br>
                                        @endforeach
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                @endif
                            </td>

                            {{-- Périphériques --}}
                            <td>
                                @if($log->action_type === 'Modification')
                                    {{-- Périphériques ajoutés --}}
                                    @php
                                        $peripheriquesAjoutes = is_string($log->peripheriques_ajoutes) ? json_decode($log->peripheriques_ajoutes, true) : $log->peripheriques_ajoutes;
                                    @endphp
                                    @if(!empty($peripheriquesAjoutes))
                                        <div><strong>Ajoutés :</strong></div>
                                        @foreach($peripheriquesAjoutes as $peripheriqueId)
                                            @php $peripherique = \App\Models\Peripherique::find($peripheriqueId); @endphp
                                            <span class="mb-1 badge bg-success d-inline-block">
                                                {{ $peripherique ? $peripherique->num_serie_peripherique . ' - ' . $peripherique->designation_peripherique : "Introuvable (ID: $peripheriqueId)" }}
                                            </span><br>
                                        @endforeach
                                    @endif

                                    {{-- Périphériques retirés --}}
                                    @php
                                        $peripheriquesRetires = is_string($log->peripheriques_retires) ? json_decode($log->peripheriques_retires, true) : $log->peripheriques_retires;
                                    @endphp
                                    @if(!empty($peripheriquesRetires))
                                        <div><strong>Retirés :</strong></div>
                                        @foreach($peripheriquesRetires as $peripheriqueId)
                                            @php $peripherique = \App\Models\Peripherique::find($peripheriqueId); @endphp
                                            <span class="mb-1 badge bg-danger d-inline-block">
                                                {{ $peripherique ? $peripherique->num_serie_peripherique . ' - ' . $peripherique->designation_peripherique : "Introuvable (ID: $peripheriqueId)" }}
                                            </span><br>
                                        @endforeach
                                    @endif

                                    @if(empty($peripheriquesAjoutes) && empty($peripheriquesRetires))
                                        <span class="text-muted">N/A</span>
                                    @endif
                                @else
                                    @php
                                        $peripheriquesIds = is_string($log->peripheriques) ? json_decode($log->peripheriques, true) : $log->peripheriques;
                                    @endphp
                                    @if(!empty($peripheriquesIds))
                                        @foreach($peripheriquesIds as $peripheriqueId)
                                            @php $peripherique = \App\Models\Peripherique::find($peripheriqueId); @endphp
                                            <span class="mb-1 badge bg-warning d-inline-block">
                                                {{ $peripherique ? $peripherique->num_serie_peripherique . ' - ' . $peripherique->designation_peripherique : "Introuvable (ID: $peripheriqueId)" }}
                                            </span><br>
                                        @endforeach
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                @endif
                            </td>

                            {{-- Date --}}
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







    <div class="mt-4 d-flex justify-content-start">
          {{ $logs->links() }}
    </div>

</div>
@endsection
