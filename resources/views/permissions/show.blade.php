@extends('layouts.app')

@section('title', 'Visualiser Permission')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Détails de la permission</h3>
    </div>
    <div class="card-body">
        <p><strong>ID :</strong> {{ $permission->id }}</p>
        <p><strong>Nom :</strong> {{ $permission->name }}</p>
        <p><strong>Guard Name :</strong> {{ $permission->guard_name }}</p>
        <p><strong>Créé le :</strong> {{ $permission->created_at->format('d/m/Y H:i') }}</p>
        <p><strong>Mis à jour le :</strong> {{ $permission->updated_at->format('d/m/Y H:i') }}</p>
        <a href="{{ route('permissions.index') }}" class="btn btn-secondary">Retour</a>


    </div>
</div>
@endsection
