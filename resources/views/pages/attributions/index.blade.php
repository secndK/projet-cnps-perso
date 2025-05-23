@extends('layouts.app')
@section('title', 'Gestion des attributions')


@section('voidgrubs')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">Attribution</li>
  </ol>
</nav>
@endsection

@section('content')

<div class="container">
    <form method="GET" class="mb-4 row g-4 align-items-end">



    <div class="col-md-4">
        <label for="search" class="form-label">Rechercher un agent</label>
        <input type="text" name="search" id="search" class="form-control" placeholder="Nom ou prénom"
        value="{{ request('search') }}">
    </div>
    <div class="gap-2 col-md-2 d-flex">
        <button type="submit" class="btn btn-outline-success"><i class="bi bi-search"></i> </button>
        <a href="{{ route('attributions.index') }}" class="btn btn-outline-danger"><i class="bi bi-arrow-counterclockwise"></i></a>
    </div>
    <div class=" col-md-2">
        <a href="{{ route('attributions.create') }}" class="btn btn-secondary">Nouvelle attribution</a>
    </div>
</form>


<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead class="text-white bg-primary">
            <tr>
                <th scope="col">N°</th>
                <th >Agent bénéficiaire</th>
                <th>Postes</th>
                <th>Périphériques</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @forelse ($attributions as $attribution)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td> {{ $attribution->agent->matricule_agent  }}</td>
                <td>
                    @foreach ($attribution->postes as $poste)
                        <span class="badge bg-warning"><i class="bi bi-laptop"></i> {{ $poste->nom_poste }}</span>
                    @endforeach
                </td>
                <td>
                    @foreach ($attribution->peripheriques as $peripherique)
                        <span class="badge bg-warning"><i class="bi bi-mouse"></i> {{ $peripherique->nom_peripherique }}</span>
                    @endforeach
                </td>
                <td>
                    @if(is_null($attribution->date_retrait))
                        <a href="{{ route('attributions.show', $attribution) }}" class="btn btn-outline-success btn-sm"><i class="bi bi-eye"></i></a>
                        <a href="{{ route('attributions.edit', $attribution) }}" class="btn btn-outline-primary btn-sm"><i class="bi bi-pencil"></i></a>
                        <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteAttributionModal{{ $attribution->id }}"><i class="bi bi-trash3"></i></button>
                    @else
                        <a href="{{ route('attributions.show', $attribution) }}" class="btn btn-danger btn-sm"><i class="bi bi-eye"></i></a>
                    @endif
                </td>
            </tr>
            @include('pages.attributions.modals.delete', ['attribution' => $attribution])
        @empty
            <tr>
                <td colspan="5" class="text-center text-muted">Aucune attribution.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4 d-flex justify-content-start">
          {{ $attributions->links() }}
</div>
</div>







@endsection
