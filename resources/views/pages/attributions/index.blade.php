@extends('layouts.app')
@section('title', 'Gestion des attributions')
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
                    <th width="15%" >Agent</th>
                    <th >Postes</th>
                    <th >Périphériques</th>
                    <th width="10%">Action</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($attributions as $attribution)

                <tr><td scope="row">{{ $loop->index + 1 }}</td>

                    <td>{{ $attribution->agent->nom_agent }} {{ $attribution->agent->prenom_agent }}</td>
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
                        @if(is_null($attribution->date_retrait))
                            <a href="{{ route('attributions.show', $attribution) }}" class="btn btn-outline-success btn-sm "><i class="bi bi-eye"></i></a>
                            <a href="{{ route('attributions.edit', $attribution) }}" class="btn btn-outline-primary btn-sm"><i class="bi bi-pencil"></i></a>
                            <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteAttributionModal{{ $attribution->id }}"><i class="bi bi-trash3"></i></button>
                        @else

                            <a href="{{ route('attributions.show', $attribution) }}" class="btn btn-danger btn-sm "><i class="bi bi-eye"></i></a>
                        @endif

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

@section('script')
<script>
    $(document).ready(function () {
        $('.datatable').DataTable();
        responsive: true
    });
</script>
@endsection
