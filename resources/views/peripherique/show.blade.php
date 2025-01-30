@extends('layouts.app')

@section('title', 'Gestion des Périphériques')

@section('content')

<br>
<br>

<div class="card">
    <div class="card-header bg-light">
        <h5 class="mb-0">Détails du Périphérique</h5>
    </div>

    <div class="card-body">
        <form>

            <div class="mt-3 row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="NumSeriePeripherique" class="form-label">N° de serie</label>
                        <input type="text" name="num_serie_peripherique" class="form-control" id="NumSeriePeripherique" value="{{ $peripheriques->num_serie_peripherique }}" disabled>
                    </div>
                </div>

                <div class="mt-3 col-6">
                    <div class="form-group">
                        <label for="NumInventairePeripherique" class="form-label">N° d'inventaire</label>
                        <input type="text" name="num_inventaire_peripherique" class="form-control" id="NumInventairePeripherique" value="{{ $peripheriques->num_inventaire_peripherique }}" disabled>
                    </div>
                </div>


                <div class="mt-3 col-6">
                    <div class="form-group">
                        <label for="NomPeripherique" class="form-label">Nom periphérique</label>
                        <input type="text" name="nom_peripherique" class="form-control" id="NomPeripherique" value="{{ $peripheriques->nom_peripherique }}" disabled>
                    </div>
                </div>


                <div class="mt-3 col-6">
                    <div class="form-group">
                        <label for="DesignationPeripherique" class="form-label">Designation</label>
                        <input type="text" name="designation_peripherique" class="form-control" id="DesignationPeripherique" value="{{ $peripheriques->designation_peripherique }}" disabled >
                    </div>
                </div>

                <div class="mt-3 col-6">
                    <div class="form-group">
                        <label for="EtatPeripherique" class="form-label">Etat</label>
                        <input type="text" class="form-control" id="EtatPeripherique" value="{{ $peripheriques->etat_peripherique }}" disabled>
                    </div>
                </div>
                <div class="mt-3 col-6">
                    <div class="form-group">
                        <label for="TypePeripherique" class="form-label">Type</label>
                        <input type="text" class="form-control" id="TypePeripherique" value="{{ $peripheriques->type_peripherique }}" disabled>
                    </div>
                </div>
                <div class="mt-3 col-6">
                    <div class="form-group">
                        <label for="DateAcq" class="form-label">Date acquisition</label>
                        <input type="date" name="date_acq" class="form-control" id="DateAcq" value="{{ \Carbon\Carbon::parse($peripheriques->date_acq)->format('Y-m-d') }}" disabled>
                    </div>
                </div>

            </div>



        </form>

    </div>

    <div class="card-footer">
        <div class="mt-1 d-flex justify-content-start">
            <a href="{{ route('peripherique.index') }}" class="btn btn-secondary">Retour</a>
        </div>
    </div>
</div>

@endsection
