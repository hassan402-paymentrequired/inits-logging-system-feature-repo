@extends('layouts.main-layout')

@section('title', 'Analytics Report')

@section('main-content')
@include('components.breadcrumb', [
  'title' => 'Analytics Report',
  'items' => [
      ['name' => 'Analytics', 'url' => '#', 'active' => false],
      ['name' => 'Report', 'url' => 'reports', 'active' => true],
  ],
  'buttonUrl' => '#',
  'buttonIcon' => 'bi bi-printer',
  'buttonText' => 'Print Report'
])

<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="text-center">Detailed Analytics Report</h2>
            <p class="text-center">A comprehensive view of check-ins and visitor statistics.</p>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6 mb-4">
            <div class="card shadow">
                <div class="card-header">
                    <h5>Staff Check-Ins</h5>
                </div>
                <div class="card-body">
                    <canvas id="staffCheckInChart" style="height: 300px;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card shadow">
                <div class="card-header">
                    <h5>Visitor Check-Ins</h5>
                </div>
                <div class="card-body">
                    <canvas id="visitorCheckInChart" style="height: 300px;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    <h5>Weekly Check-Ins Summary</h5>
                </div>
                <div class="card-body">
                    <canvas id="weeklyCheckInChart" style="height: 300px;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    <h5>Busiest Days of the Week</h5>
                </div>
                <div class="card-body">
                    <canvas id="busiestDaysChart" style="height: 300px;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Chart for Staff Check-Ins
    const staffCheckInCtx = document.getElementById('staffCheckInChart').getContext('2d');
    const staffCheckInChart = new Chart(staffCheckInCtx, {
        type: 'bar',
        data: {
            labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
            datasets: [{
                label: 'Staff Check-Ins',
                data: [50, 75, 100, 125],
                backgroundColor: 'rgba(0, 0, 139, 0.6)',
                borderColor: 'rgba(0, 0, 139, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Chart for Visitor Check-Ins
    const visitorCheckInCtx = document.getElementById('visitorCheckInChart').getContext('2d');
    const visitorCheckInChart = new Chart(visitorCheckInCtx, {
        type: 'bar',
        data: {
            labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
            datasets: [{
                label: 'Visitor Check-Ins',
                data: [30, 45, 60, 80],
                backgroundColor: 'rgba(0, 128, 0, 0.6)',
                borderColor: 'rgba(0, 128, 0, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Chart for Weekly Check-Ins Summary
    const weeklyCheckInCtx = document.getElementById('weeklyCheckInChart').getContext('2d');
    const weeklyCheckInChart = new Chart(weeklyCheckInCtx, {
        type: 'line',
        data: {
            labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
            datasets: [
                {
                    label: 'Staff Check-Ins',
                    data: [50, 75, 100, 125],
                    fill: false,
                    borderColor: 'rgba(0, 0, 139, 1)'
                },
                {
                    label: 'Visitor Check-Ins',
                    data: [30, 45, 60, 80],
                    fill: false,
                    borderColor: 'rgba(0, 128, 0, 1)'
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Chart for Busiest Days of the Week
    const busiestDaysCtx = document.getElementById('busiestDaysChart').getContext('2d');
    const busiestDaysChart = new Chart(busiestDaysCtx, {
        type: 'pie',
        data: {
            labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
            datasets: [{
                label: 'Busiest Days',
                data: [15, 20, 25, 30, 10, 5, 10],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(153, 102, 255, 0.6)',
                    'rgba(255, 159, 64, 0.6)',
                    'rgba(201, 203, 207, 0.6)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(201, 203, 207, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Busiest Days of the Week'
                }
            }
        }
    });
</script>

@endsection
