@extends('layouts.app')

@section('title', 'Gestion des Périphériques')

@section('voidgrubs')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('types-peripheriques.index') }}">Type périphérique</a></li>
    <li class="breadcrumb-item active" aria-current="page">Édition de type périphérique</li>
  </ol>
</nav>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        Modifier un type de périphérique
    </div>

    <div class="card-body">
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('types-peripheriques.update', $types->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3 col-12">
                <label for="libelleType" class="form-label">Type de périphérique</label>
                <input type="text" name="libelle_type" class="form-control" id="libelleType"
                    value="{{ old('libelle_type', $types->libelle_type) }}" required>
            </div>

            <div class="mt-3 d-flex justify-content-between">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Retour</a>
                <button type="submit" class="btn btn-primary">Mettre à jour</button>
            </div>
        </form>
    </div>
</div>
@endsection
