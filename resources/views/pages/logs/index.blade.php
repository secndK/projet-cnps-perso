@extends('layouts.app')

@section('title', 'Gestion des Logs')

@section('content')
<div class="card">
    <div class="card-header">
        <div>
        </div>
    </div>
    <div class="card-body">
        <table id="tablelogs" class="table datatable table-sm">
            <thead>
                <tr>
                    <th width="1%">N°</th>
                    <th>Auteur</th>
                    <th>Évènement</th>
                    <th>Détail évènement</th>
                    <th>Date évènement</th>
                    <th>Date MAJ</th>
                    {{-- <th>Action</th> --}}
                </tr>
            </thead>
            <tbody>
            @forelse ($logs as $log)
                <tr>
                    <td>{{ $log->id }}</td>
                    <td>{{ $log->user }}</td>
                    <td>{{ $log->event_type }}</td>
                    <td>{{ $log->details }}</td>
                    <td>{{ $log->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ $log->updated_at->format('d/m/Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Aucun log trouvé.</td>
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
