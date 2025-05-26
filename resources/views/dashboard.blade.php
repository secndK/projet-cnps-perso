@extends('layouts.app')

@section('title', 'Dashboard')

@section('voidgrubs')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">Page d'accueil</li>
  </ol>
</nav>
@endsection

@section('content')
<div class="container py-4">
    <!-- Carrousel Postes -->
    <div class="mb-5">
        <h3 class="mb-4 text-primary">
            <i class="bi bi-pc-display-horizontal me-2"></i>Statut des Postes
        </h3>

        <div id="postesCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach($postesStats->chunk(3) as $chunk)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <div class="row g-3">
                        @foreach($chunk as $type)
                        <div class="col-md-4">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    <div class="mt-2">

                                        @if($type->libelle_type === 'PC Bureau')

                                            <i class="bi bi-pc-display text-primary fs-1"></i>

                                        @elseif ($type->libelle_type === 'PC PORTABLE')

                                            <i class="bi bi-laptop text-primary fs-1"></i>

                                        @elseif ($type->libelle_type === 'Téléphone ip')
                                            <i class="bi bi-telephone-fill text-primary fs-1"></i>

                                        @elseif ($type->libelle_type === 'Téléphone portable')

                                            <i class="bi bi-phone text-primary fs-1"></i>

                                        @endif


                                    </div>
                                    <h5 class="card-title">{{ $type->libelle_type }}</h5>
                                    <h3 class="my-3">{{ $type->total }}</h3>

                                    <div class="d-flex justify-content-around">
                                        <div>
                                            <span class="badge bg-success">{{ $type->disponibles }}</span>
                                            <small class="d-block">Disponibles</small>
                                        </div>
                                        <div>
                                            <span class="badge bg-warning">{{ $type->attribues }}</span>
                                            <small class="d-block">Attribués</small>
                                        </div>
                                        <div>
                                            <span class="badge bg-danger">{{ $type->reformes }}</span>
                                            <small class="d-block">Réformés</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Contrôles en bas -->
            <div class="text-center mt-3">
                <button class="btn btn-sm btn-outline-primary mx-1" data-bs-target="#postesCarousel" data-bs-slide="prev">
                    <i class="bi bi-chevron-left"></i>
                </button>
                @foreach($postesStats->chunk(3) as $index => $chunk)
                <button type="button" data-bs-target="#postesCarousel" data-bs-slide-to="{{ $index }}"
                    class="btn btn-sm btn-outline-primary mx-1 {{ $loop->first ? 'active' : '' }}">
                    {{ $index + 1 }}
                </button>
                @endforeach
                <button class="btn btn-sm btn-outline-primary mx-1" data-bs-target="#postesCarousel" data-bs-slide="next">
                    <i class="bi bi-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Carrousel Périphériques -->
    <div class="mb-5">
        <h3 class="mb-4 text-success">
            <i class="bi bi-usb-symbol me-2"></i>Statut des Périphériques
        </h3>

        <div id="peripheriquesCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach($peripheriquesStats->chunk(3) as $chunk)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <div class="row g-3">
                        @foreach($chunk as $type)
                        <div class="col-md-4">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    <div class="mt-">

                                        @if ($type->libelle_type === 'Souris')

                                            <i class="bi bi-mouse3-fill text-success fs-1"></i>

                                        @elseif ($type->libelle_type === 'clavier')
                                            <i class="bi bi-keyboard text-success fs-1"></i>

                                        @elseif ($type->libelle_type === 'ecran')

                                            <i class="bi bi-display text-success fs-1"></i>

                                        @elseif ($type->libelle_type === 'box wifi')

                                            <i class="bi bi-router-fill text-success fs-1"></i>

                                        @elseif ($type->libelle_type === 'projecteur')

                                            <i class="bi bi-projector text-success fs-1"></i>


                                        @elseif ($type->libelle_type === 'Domino wi-fi')


                                            <i class="bi bi-wifi text-success fs-1"></i>



                                        @endif

                                    </div>
                                    <h5 class="card-title">{{ $type->libelle_type }}</h5>
                                    <h3 class="my-3">{{ $type->total }}</h3>

                                    <div class="d-flex justify-content-around">
                                        <div>
                                            <span class="badge bg-success">{{ $type->disponibles }}</span>
                                            <small class="d-block">Disponibles</small>
                                        </div>
                                        <div>
                                            <span class="badge bg-warning">{{ $type->attribues }}</span>
                                            <small class="d-block">Attribués</small>
                                        </div>
                                        <div>
                                            <span class="badge bg-danger">{{ $type->reformes }}</span>
                                            <small class="d-block">Réformés</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Contrôles en bas -->
            <div class="text-center mt-3">
                <button class="btn btn-sm btn-outline-success mx-1" data-bs-target="#peripheriquesCarousel" data-bs-slide="prev">
                    <i class="bi bi-chevron-left"></i>
                </button>
                @foreach($peripheriquesStats->chunk(3) as $index => $chunk)
                <button type="button" data-bs-target="#peripheriquesCarousel" data-bs-slide-to="{{ $index }}"
                    class="btn btn-sm btn-outline-success mx-1 {{ $loop->first ? 'active' : '' }}">
                    {{ $index + 1 }}
                </button>
                @endforeach
                <button class="btn btn-sm btn-outline-success mx-1" data-bs-target="#peripheriquesCarousel" data-bs-slide="next">
                    <i class="bi bi-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <!-- État des postes par type -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">État des postes par type</h5>
                <canvas id="postesEtatChart" width="600" height="400"></canvas>
            </div>
        </div>
    </div>

    <!-- État des périphériques par type -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">État des périphériques par type</h5>
                <canvas id="peripheriquesEtatChart" width="600" height="400"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const postesStats = @json($postesStats);
        const peripheriquesStats = @json($peripheriquesStats);

        const etats = ['Bon', 'en_service', 'en_panne', 'défectueux'];

        const couleurs = {
            Bon: 'rgba(75, 192, 192, 0.7)',
            en_service: 'rgba(54, 162, 235, 0.7)',
            en_panne: 'rgba(255, 99, 132, 0.7)',
            défectueux: 'rgba(255, 205, 86, 0.7)'
        };

        const borderCouleurs = {
            Bon: 'rgba(75, 192, 192, 1)',
            en_service: 'rgba(54, 162, 235, 1)',
            en_panne: 'rgba(255, 99, 132, 1)',
            défectueux: 'rgba(255, 205, 86, 1)'
        };

        // Données pour les postes
        const postesLabels = postesStats.map(p => p.libelle_type);
        const postesDatasets = etats.map(etat => ({
            label: etat.replace('_', ' ').toUpperCase(),
            data: postesStats.map(p => p[etat] ?? 0),
            backgroundColor: couleurs[etat],
            borderColor: borderCouleurs[etat],
            borderWidth: 1
        }));

        new Chart(document.getElementById('postesEtatChart'), {
            type: 'bar',
            data: {
                labels: postesLabels,
                datasets: postesDatasets
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        stacked: false,
                        title: {
                            display: true,
                            text: 'Types de postes'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        stacked: false,
                        title: {
                            display: true,
                            text: 'Nombre de postes'
                        }
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'État des postes par type'
                    }
                }
            }
        });

        // Données pour les périphériques
        const periphLabels = peripheriquesStats.map(p => p.libelle_type);
        const periphDatasets = etats.map(etat => ({
            label: etat.replace('_', ' ').toUpperCase(),
            data: peripheriquesStats.map(p => p[etat] ?? 0),
            backgroundColor: couleurs[etat],
            borderColor: borderCouleurs[etat],
            borderWidth: 1
        }));

        new Chart(document.getElementById('peripheriquesEtatChart'), {
            type: 'bar',
            data: {
                labels: periphLabels,
                datasets: periphDatasets
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        stacked: false,
                        title: {
                            display: true,
                            text: 'Types de périphériques'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        stacked: false,
                        title: {
                            display: true,
                            text: 'Nombre de périphériques'
                        }
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'État des périphériques par type'
                    }
                }
            }
        });
    });
</script>

    <style>
        .card {
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: transform 0.2s;
        }
        .card:hover {
            transform: translateY(-3px);
        }
        .carousel-indicators [data-bs-target] {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin: 0 5px;
        }
    </style>
@endsection
