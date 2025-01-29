@extends('layouts.app')

@section('title', 'Éditer Permission')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Éditer la permission</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('permissions.update', $permission->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Nom de la permission</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $permission->name }}">
            </div>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
            <a href="{{ route('permissions.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</div>
@endsection
