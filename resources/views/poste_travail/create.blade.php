@extends('layouts.app')

@section('title', 'Ajout poste de travail')

@section('content')



<div class="card">

    <div class="card-header">
        Ajoutez un nouveau poste de travail
    </div>


    <div class="card-body">

        <form action="{{ route('poste_travail.store') }}" method="POST">
            @csrf
           
        </form>
    </div>
</div



@endsection



