@extends('layouts.main-layout')

@section('title', 'Dashboard')

@section('main-content')

@php
    $chartIcon = count($checked_in_staff_today) < 60 ? 'bi-graph-down-arrow' : 'bi-graph-up-arrow';
    $chartIconColor = count($checked_in_staff_today) < 60 ? 'text-danger' : 'text-success';


    $busiestWeekData = [
        'Monday' => 15,
        'Tuesday' => 25,
        'Wednesday' => 30,
        'Thursday' => 35,
        'Friday' => 40,
    ];
    
    $weekDays = array_keys($busiestWeekData);
    $checkInCounts = array_values($busiestWeekData);
@endphp



{{-- Breadcrumb Navigation --}}
@include('components.breadcrumb', [
  'title' => 'Dashboard',
  'items' => [
      ['name' => 'Dashboard', 'url' => '#', 'active' => false],
      ['name' => 'Home', 'url' => '#', 'active' => true],
  ],
  'buttonUrl' => '#', // Replace with actual URL for the button
  'buttonIcon' => 'bi bi-filetype-pdf', // Change icon as needed
  'buttonText' => 'Download PDF' // Change text as needed
])
<div class="d-flex flex-column flex-md-row align-items-center w-100 mb-3">
  <small class="text-muted mb-2 mb-md-0 me-md-3">
    Visitor/Staffs checkins overview & summary for: 
   <span class="text-muted fw-semibold fst-italic"> {{ \Carbon\Carbon::parse($selectedDate)->format('F j, Y') }}</small>
</span>
  {{-- Date Picker Form --}}
  <form action="{{ route('dashboard') }}" method="GET" class="ms-md-auto">
      <div class="input-group">
      
          <input type="date" class="form-control text-primary" name="selected_date" value="{{ $selectedDate }}" required />
          <button class="btn btn-sm btn-secondary" type="submit">select date</button>
      </div>
  </form>
</div>

{{-- Card Components for Staff, Visitors, and Overall Activities --}}
<x-card borderColor="border-success" colorClass="shalow-green" icon="bi-binoculars" iconColor="text-success" textColor="text-success" count="{{ count($checked_in_staff_today) + count($checked_in_visitors_today) }}" countsColor="text-success" title="Overall checkin's" chartIcon="bi-activity" chartIconColor="text-success" />

<x-card 
    borderColor="border-primary" 
    colorClass="shalow-blue" 
    icon="bi-person-workspace" 
    iconColor="text-primary" 
    textColor="text-dark" 
    count="{{ count($checked_in_staff_today) }}" 
    countsColor="text-primary" 
    title="Checked-in Staffs" 
    chartIcon="{{ $chartIcon }}" 
    chartIconColor="{{ $chartIconColor }}" 
/>

<x-card borderColor="border-secondary"
 colorClass="shalow-dark"
  icon="bi-people-fill"
   iconColor="text-dark"
    textColor="text-success"
     count="{{ count($checked_in_visitors_today) }}" 
     countsColor="text-success" 
     title="Checked-in Visitors"    
     chartIcon="{{ $chartIcon }}" 
     chartIconColor="{{ $chartIconColor }}" 
/>



{{-- Analytics Overview (Heat Chart for Busiest Week) --}}
<div class="container">
  <div class="row mb-4">
      <div class="col-lg-8 mb-3">
          <div class="card card-raised h-100">
              <div class="card-header bg-transparent p-4">
                  <h5><small>Busiest days for this week</small></h5>
              </div>
              <div class="card-body">
                  <canvas id="busiestWeekChart" style="height: 300px;"></canvas>
              </div>
              <div class="card-footer p-3 d-flex bg-white">
                <a href="" class="report-link ms-auto">OPEN REPORT<i class="bi bi-arrow-right"></i></a>
            </div>
          </div>
      </div>

            {{--  (Pie Chart) --}}
            <div class="col-lg-4">
              <div class="card card-raised h-100">
                <div class="card-header bg-transparent p-4">
                  <h5 class="card-title fw-normal"><small>Checkins demographics</small></h5>
                  {{--  <div class="dropdown d-inline-block">
                    <button class="btn btn-text-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                      Gender
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <li><a class="dropdown-item" href="#">Vistors & staffs</a></li>
                      <li><a class="dropdown-item" href="#">Staffs</a></li>
                      <li><a class="dropdown-item" href="#">Visitors</a></li>
                    </ul>
                  </div>  --}}
                </div>
                <div class="card-body p-4">
                  <canvas id="dashboardPieChart" width="372" height="372"></canvas>
                </div>
                <div class="card-footer p-3 d-flex bg-white">
                  <a href="" class="report-link ms-auto">OPEN REPORT<i class="bi bi-arrow-right"></i></a>
              </div>
              </div>
            </div>
        </div>
      </div>
  </div>
</div>



{{-- Chart.js Script for Heat Chart --}}
<script>
  const ctx = document.getElementById('busiestWeekChart').getContext('2d');
  const busiestWeekChart = new Chart(ctx, {
      type: 'bar',
      data: {
          labels: {!! json_encode($weekDays) !!}, // Days of the week
          datasets: [{
              label: 'Check-Ins',
              data: {!! json_encode($checkInCounts) !!}, // Daily check-in counts
              backgroundColor: function(context) {
                  const value = context.dataset.data[context.dataIndex];
                  let color;
                  if (value < 20) {
                      color = 'rgba(255, 99, 132, 0.2)'; // Low count (light red)
                  } else if (value < 30) {
                      color = 'rgba(255, 159, 64, 0.2)'; // Medium count (orange)
                  } else {
                      color = 'rgba(75, 192, 192, 0.2)'; // High count (light green)
                  }
                  return color;
              },
              borderColor: function(context) {
                  const value = context.dataset.data[context.dataIndex];
                  let borderColor;
                  if (value < 20) {
                      borderColor = 'rgba(255, 99, 132, 1)'; // Low count (red)
                  } else if (value < 30) {
                      borderColor = 'rgba(255, 159, 64, 1)'; // Medium count (orange)
                  } else {
                      borderColor = 'rgba(75, 192, 192, 1)'; // High count (green)
                  }
                  return borderColor;
              },
              borderWidth: 1
          }]
      },
      options: {
          scales: {
              y: {
                  beginAtZero: true,
                  title: {
                      display: true,
                      text: 'Number of Check-Ins'
                  }
              }
          },
          plugins: {
              tooltip: {
                  callbacks: {
                      label: function(tooltipItem) {
                          return ` ${tooltipItem.label}: ${tooltipItem.raw} check-ins`;
                      }
                  }
              }
          }
      }
  });

    @if (session('success'))
  Swal.fire({
      icon: 'success',
      title: 'Success!',
      text: '{{ session('success') }}',
      position: 'top-end',
      timer: 3000,
      timerProgressBar: true,
      showConfirmButton: false
  });
  @endif
</script>

{{-- Chart.js Script for Pie Chart --}}
{{--  <script>
  const pieCtx = document.getElementById('dashboardPieChart').getContext('2d');
  const dashboardPieChart = new Chart(pieCtx, {
      type: 'pie',
      data: {
          labels: ['Segment A', 'Segment B', 'Segment C'], // Update with actual labels
          datasets: [{
              data: [40, 30, 30], // Replace with dynamic sales data
              backgroundColor: ['#007bff', '#28a745', '#dc3545'], // Colors for segments
              hoverBackgroundColor: ['#0056b3', '#218838', '#c82333'],
              borderWidth: 1
          }]
      },
      options: {
          responsive: true,
          plugins: {
              legend: {
                  position: 'bottom'
              }
          }
      }
  });

    @if (session('success'))
  Swal.fire({
      icon: 'success',
      title: 'Success!',
      text: '{{ session('success') }}',
      position: 'top-end',
      timer: 3000,
      timerProgressBar: true,
      showConfirmButton: false
  });
  @endif
</script>  --}}
<script>
  document.addEventListener('DOMContentLoaded', function () {
      var ctx = document.getElementById('dashboardPieChart').getContext('2d');
      var dashboardPieChart = new Chart(ctx, {
          type: 'pie',
          data: {
              labels: ['Male Staff', 'Female Staff', 'Male Visitors', 'Female Visitors'],
              datasets: [{
                  label: 'Gender Distribution',
                  data: [
                      {{ $staff_gender_count['male'] }},
                      {{ $staff_gender_count['female'] }},
                      {{ $visitor_gender_count['male'] }},
                      {{ $visitor_gender_count['female'] }}
                  ],
                  backgroundColor: [
                      'rgba(54, 162, 235, 0.2)', // Male Staff
                      'rgba(255, 99, 132, 0.2)', // Female Staff
                      'rgba(75, 192, 192, 0.2)', // Male Visitors
                      'rgba(255, 159, 64, 0.2)',  // Female Visitors
                  ],
                  borderColor: [
                      'rgba(54, 162, 235, 1)',
                      'rgba(255, 99, 132, 1)',
                      'rgba(75, 192, 192, 1)',
                      'rgba(255, 159, 64, 1)'
                  ],
                  borderWidth: 1
              }]
          },
          options: {
              responsive: true,
              plugins: {
                  legend: {
                      position: 'top',
                  }
              }
          }
      });
  });
</script>

@endsection

