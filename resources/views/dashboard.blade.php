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
<section class="section dashboard">
  <div class="row justify-content-center">

    <!-- Statistiques globales -->
    <div class="col-lg-8">
      <div class="row d-flex justify-content-center g-4">

        <!-- Poste Card -->
        <div class="col-xxl-4 col-md-6 d-flex">
          <div class="card info-card poste-card flex-fill h-100">
            <div class="card-body">
              <h2 class="card-title">Postes</h2>
              <div class="d-flex align-items-center">
                <div class="text-white card-icon rounded-circle d-flex align-items-center justify-content-center bg-primary">
                  <i class="bi bi-pc-display-horizontal fs-4"></i>
                </div>
                <div class="ps-3">
                  <h6>{{ $data['postes_total'] }} <span class="text-muted small">postes au total</span></h6>
                  <span class="text-success small fw-bold">{{ $data['postes_disponibles'] }}</span>
                  <span class="text-muted small ps-1">disponibles</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Périphérique Card -->
        <div class="col-xxl-4 col-md-6 d-flex">
          <div class="card info-card peripherique-card flex-fill h-100">
            <div class="card-body">
              <h2 class="card-title">Périphériques</h2>
              <div class="d-flex align-items-center">
                <div class="text-white card-icon rounded-circle d-flex align-items-center justify-content-center bg-success">
                  <i class="bi bi-usb-symbol fs-4"></i>
                </div>
                <div class="ps-3">
                  <h6>{{ $data['peripheriques_total'] }} <span class="text-muted small">périphériques au total</span></h6>
                  <span class="text-success small fw-bold">{{ $data['peripheriques_disponibles'] }}</span>
                  <span class="text-muted small ps-1">disponibles</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Utilisateurs Card -->
        <div class="col-xxl-4 col-md-6 d-flex">
          <div class="card info-card user-card flex-fill h-100">
            <div class="card-body">
              <h2 class="card-title">Utilisateurs</h2>
              <div class="d-flex align-items-center">
                <div class="text-white card-icon rounded-circle d-flex align-items-center justify-content-center bg-dark">
                  <i class="bi bi-people fs-4"></i>
                </div>
                <div class="ps-3">
                  <h6>{{ $data['utilisateurs_total'] }} <span class="text-muted small">utilisateurs enregistrés</span></h6>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

      <!-- Graphiques circulaires -->
      <div class="mt-4 row justify-content-center g-4">

        <!-- Card Postes -->
        <div class="col-md-4">
          <div class="card h-100">
            <div class="card-body">
              <h5 class="mb-3 card-title">Statuts des Postes</h5>
              <div class="mb-3 d-flex justify-content-around">
                <div class="text-center">
                  <h6 class="text-success">{{ $data['postes_disponibles'] }}</h6>
                  <small>Disponibles</small>
                </div>
                <div class="text-center">
                  <h6 class="text-warning">{{ $data['postes_attribues'] }}</h6>
                  <small>Attribués</small>
                </div>
                <div class="text-center">
                  <h6 class="text-danger">{{ $data['postes_reformes'] }}</h6>
                  <small>Réformés</small>
                </div>
              </div>
              <canvas id="postesChart" height="180"></canvas>
            </div>
          </div>
        </div>

        <!-- Card Périphériques -->
        <div class="col-md-4">
          <div class="card h-100">
            <div class="card-body">
              <h5 class="mb-3 card-title">Statuts des Périphériques</h5>
              <div class="mb-3 d-flex justify-content-around">
                <div class="text-center">
                  <h6 class="text-success">{{ $data['peripheriques_disponibles'] }}</h6>
                  <small>Disponibles</small>
                </div>
                <div class="text-center">
                  <h6 class="text-warning">{{ $data['peripheriques_attribues'] }}</h6>
                  <small>Attribués</small>
                </div>
                <div class="text-center">
                  <h6 class="text-danger">{{ $data['peripheriques_reformes'] }}</h6>
                  <small>Réformés</small>
                </div>
              </div>
              <canvas id="peripheriquesChart" height="180"></canvas>
            </div>
          </div>
        </div>

        <!-- Card Rôles -->
        <div class="col-md-4">
          <div class="card h-100">
            <div class="card-body">
              <h5 class="mb-3 card-title">Rôles des Utilisateurs</h5>
              <div class="mb-3 d-flex justify-content-around">
                <div class="text-center">
                  <h6 class="text-purple">{{ $data['roles']['super admin'] ?? 0 }}</h6>
                  <small>Super Admin</small>
                </div>
                <div class="text-center">
                  <h6 class="text-primary">{{ $data['roles']['admin'] ?? 0 }}</h6>
                  <small>Admin</small>
                </div>
                <div class="text-center">
                  <h6 class="text-muted">{{ $data['roles']['user'] ?? 0 }}</h6>
                  <small>Utilisateur</small>
                </div>
              </div>
              <canvas id="rolesChart" height="180"></canvas>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
  const options = {
    responsive: true,
    plugins: {
      legend: { position: 'bottom' },
      tooltip: { enabled: true }
    }
  };

  new Chart(document.getElementById('postesChart'), {
    type: 'doughnut',
    data: {
      labels: ['Disponibles', 'Attribués', 'Réformés'],
      datasets: [{
        data: [{{ $data['postes_disponibles'] }}, {{ $data['postes_attribues'] }}, {{ $data['postes_reformes'] }}],
        backgroundColor: ['rgba(40, 167, 69, 0.7)', 'rgba(255, 193, 7, 0.7)', 'rgba(220, 53, 69, 0.7)'],
        borderColor: ['rgba(40, 167, 69, 1)', 'rgba(255, 193, 7, 1)', 'rgba(220, 53, 69, 1)'],
        borderWidth: 1
      }]
    },
    options: options
  });

  new Chart(document.getElementById('peripheriquesChart'), {
    type: 'doughnut',
    data: {
      labels: ['Disponibles', 'Attribués', 'Réformés'],
      datasets: [{
        data: [{{ $data['peripheriques_disponibles'] }}, {{ $data['peripheriques_attribues'] }}, {{ $data['peripheriques_reformes'] }}],
        backgroundColor: ['rgba(40, 167, 69, 0.7)', 'rgba(255, 193, 7, 0.7)', 'rgba(220, 53, 69, 0.7)'],
        borderColor: ['rgba(40, 167, 69, 1)', 'rgba(255, 193, 7, 1)', 'rgba(220, 53, 69, 1)'],
        borderWidth: 1
      }]
    },
    options: options
  });

  new Chart(document.getElementById('rolesChart'), {
    type: 'doughnut',
    data: {
      labels: ['Super Admin', 'Admin', 'Utilisateur'],
      datasets: [{
        data: [{{ $data['roles']['super admin'] ?? 0 }}, {{ $data['roles']['admin'] ?? 0 }}, {{ $data['roles']['user'] ?? 0 }}],
        backgroundColor: ['#6f42c1', '#0d6efd', '#6c757d']
      }]
    },
    options: options
  });
});
</script>
@endsection
