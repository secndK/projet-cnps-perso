@extends('layouts.app')

@section('title', 'Créer une permission')
@section('voidgrubs')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('permissions.index') }}">Permissions</a></li>
    <li class="breadcrumb-item active" aria-current="page">Creation de permission</li>
  </ol>
</nav>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Créer une nouvelle permission</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('permissions.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                {{-- <label for="name" class="form-label">Nom de la permission</label> --}}
                <input type="text" class="form-control" id="name" name="name" placeholder="Entrez le nom de la permission" required>
            </div>

            <button type="submit" class="btn btn-primary">Créer</button>
            <a href="{{ route('permissions.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</div>
@endsection
