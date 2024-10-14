@extends('layouts.main-layout')

@section('title', 'Analytics')

@section('main-content')
@include('components.breadcrumb', [
  'title' => 'Analytics',
  'items' => [
      ['name' => 'Analytics', 'url' => '#', 'active' => true],
  ],
  'buttonUrl' => '#', // Replace with actual URL for the button
  'buttonIcon' => 'bi bi-bar-chart', // Change icon as needed
  'buttonText' => 'View Report' // Change text as needed
])

<div class="container">
  <div class="row mb-4">
      <div class="col-md-8">
          <div class="card shadow-lg rounded">
              <div class="card-header">
                  <h5>Check-In Analytics</h5>
              </div>
              <div class="card-body">
                  <canvas id="analyticsChart" style="height: 300px;"></canvas>
                  <p>This bar chart displays the weekly check-in data for both staff and visitors, allowing for an easy comparison of trends over the month.</p>
              </div>
          </div>
      </div>

      <div class="col-md-4">
        <div class="card shadow">
            <div class="card-header">
                <h5>Recent Check-Ins</h5>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item">John Doe - 10:00 AM</li>
                    <li class="list-group-item">Jane Smith - 10:15 AM</li>
                    <li class="list-group-item">Mike Johnson - 10:30 AM</li>
                    <li class="list-group-item">Emily Davis - 10:45 AM</li>
                </ul>
                <p>This list shows the most recent check-ins, providing real-time updates on who has entered the facility.</p>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-header">
                <h5>Summary of Check-Ins</h5>
            </div>
            <div class="card-body">
                <p>Total Staff Check-Ins: <strong>100</strong></p>
                <p>Total Visitor Check-Ins: <strong>75</strong></p>
                <p>This summary provides a quick overview of total check-ins for both staff and visitors, enabling a snapshot of activity levels.</p>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header">
                <h5>Busiest Day of the Week</h5>
            </div>
            <div class="card-body">
                <canvas id="busiestDayChart" style="height: 300px;"></canvas>
                <p>This pie chart illustrates the distribution of check-ins across the days of the week, helping to identify peak operational days.</p>
            </div>
        </div>
    </div>
</div>

<!-- Include Chart.js for the bar chart and pie chart -->
<script>
  const ctx = document.getElementById('analyticsChart').getContext('2d');
  const analyticsChart = new Chart(ctx, {
      type: 'bar',
      data: {
          labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
          datasets: [
              {
                  label: 'Staff Check-Ins',
                  data: [50, 75, 100, 125],
                  backgroundColor: 'rgba(0, 0, 139, 0.8)',
                  borderColor: 'rgba(0, 0, 139, 1)',
                  borderWidth: 1
              },
              {
                  label: 'Visitor Check-Ins',
                  data: [30, 45, 60, 80],
                  backgroundColor: 'rgba(0, 128, 0, 0.8)',
                  borderColor: 'rgba(0, 128, 0, 1)',
                  borderWidth: 1
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

  // Pie chart for busiest day of the week
  const busiestDayCtx = document.getElementById('busiestDayChart').getContext('2d');
  const busiestDayChart = new Chart(busiestDayCtx, {
      type: 'pie',
      data: {
          labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
          datasets: [{
              label: 'Busiest Day of the Week',
              data: [15, 20, 25, 30, 10, 5, 10], // Example data
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
                  text: 'Busiest Day of the Week'
              }
          }
      }
  });
</script>
@endsection
