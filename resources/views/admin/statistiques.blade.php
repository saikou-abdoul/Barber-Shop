@extends('layouts.app')

@section('title', 'Statistiques des Coiffeurs')

@section('content')
<div class="container py-5">
              <a href="{{ url()->previous() }}" class="btn btn-light border rounded-circle me-2" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
        <i class="bi bi-arrow-left"></i>
    </a>
    <div class="text-center mb-5">
        <h2 class="fw-bold">Statistiques des Rendez-vous par Coiffeur</h2>
        <p class="text-muted">Suivez les performances quotidiennes de vos coiffeurs</p>
    </div>

    <div class="row mb-5">
        <div class="col-lg-6">
            <h4 class="mb-3">Total des rendez-vous par coiffeur</h4>
            <ul class="list-group shadow-sm">
                @foreach($stats_par_coiffeur as $stat)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>{{ $stat->coiffeur->prenom ?? 'Inconnu' }}</span>
                        <span class="badge bg-primary rounded-pill">{{ $stat->total }}</span>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="col-lg-6">
            <h4 class="mb-3">📅 Rendez-vous par jour et par coiffeur</h4>
            <div class="table-responsive shadow-sm">
                <table class="table table-striped table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Coiffeur</th>
                            <th>Date</th>
                            <th>Nombre</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stats_par_coiffeur_par_jour as $stat)
                            <tr>
                                <td>{{ $stat->coiffeur->prenom ?? 'Inconnu' }}</td>
                                <td>{{ \Carbon\Carbon::parse($stat->jour)->format('d/m/Y') }}</td>
                                <td><span class="badge bg-secondary">{{ $stat->total }}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <h4 class="mb-4">📈 Évolution des rendez-vous</h4>
    <div class="card shadow-sm p-4 mb-5">
        <canvas id="chartCoiffeurs" height="120"></canvas>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const rawData = @json($stats_par_coiffeur_par_jour);

    const dataParCoiffeur = {};

    rawData.forEach(stat => {
        const jour = stat.jour;
        const nom = stat.coiffeur?.prenom ?? 'Inconnu';

        if (!dataParCoiffeur[nom]) {
            dataParCoiffeur[nom] = {};
        }

        dataParCoiffeur[nom][jour] = stat.total;
    });

    const labels = [...new Set(rawData.map(item => item.jour))].sort();

    const colorPalette = [
        '#007bff', '#28a745', '#ffc107', '#dc3545', '#17a2b8',
        '#6f42c1', '#fd7e14', '#20c997', '#6610f2', '#e83e8c'
    ];

    const datasets = Object.entries(dataParCoiffeur).map(([nom, valeurs], index) => {
        const data = labels.map(jour => valeurs[jour] ?? 0);
        return {
            label: nom,
            data,
            fill: false,
            borderColor: colorPalette[index % colorPalette.length],
            backgroundColor: colorPalette[index % colorPalette.length],
            tension: 0.3,
            pointRadius: 4,
            pointHoverRadius: 6,
        };
    });

    const ctx = document.getElementById('chartCoiffeurs').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels,
            datasets
        },
        options: {
            responsive: true,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        boxWidth: 20
                    }
                },
                title: {
                    display: true,
                    text: 'Rendez-vous quotidiens par coiffeur',
                    font: { size: 18 }
                },
                tooltip: {
                    callbacks: {
                        label: context => `${context.dataset.label} : ${context.formattedValue} rendez-vous`
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Nombre de rendez-vous'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Date'
                    }
                }
            }
        }
    });
</script>
@endsection
