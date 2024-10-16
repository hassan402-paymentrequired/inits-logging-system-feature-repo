@extends('layouts.main-layout')

@section('title', 'Dashboard')

@section('main-content')

@php
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
  'buttonUrl' => '#', 
  'buttonIcon' => 'bi bi-filetype-pdf', 
  'buttonText' => 'Download PDF',
  'buttonType' => '#',
  'buttonmodalId' => '#',
  'buttonModelType'=> '#'
   
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
<x-card
 target="#total-check-ins"
    borderColor="border-success"
    colorClass="shalow-green"
    icon="bi-binoculars"
    iconColor="text-success"
    toolTipTitle="View all checked-in staff and visitors for today"
    count="{{ count($checked_in_staff_today) + count($checked_in_visitors_today) }}"
    countsColor="text-success"
    title="Overall check-in"
    chartIcon="bi-activity"
    chartIconColor="text-success"

/>

<x-card
 target="#staff-check-ins"
    borderColor="border-primary"
    colorClass="shalow-blue"
    id="card1"
    icon="bi-person-workspace"
    iconColor="text-primary"
    toolTipTitle="View all checked-in staff for today"
    count="{{ count($checked_in_staff_today) }}"
    countsColor="text-primary"
    title="Checked-in Staffs"
    chartIcon="bi-bar-chart"
    chartIconColor="text-primary"

/>

<x-card
    target="#visitors-check-ins"
    borderColor="border-secondary"
    colorClass="shalow-dark"
    icon="bi-people-fill"
    iconColor="text-dark"
    toolTipTitle="View all checked-in visitors for today"
    count="{{ count($checked_in_visitors_today) }}"
    countsColor="text-success"
    title="Checked-in Visitors"
    chartIcon="bi-graph-up"
    chartIconColor="text-dark"
 
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
                  <h5 class="card-title fw-normal"><small>Check-in demographics</small></h5>
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

  <div id="total-check-ins" class="bg-light border border-success border-2 py-5">
    <div class="container">
      <h3 class="text-center mb-5 font-small fw-normal">Checked-in Details for {{ \Carbon\Carbon::parse($selectedDate)->format('F j, Y') }}</h3>
      
      {{-- Staff Check-ins --}}
      <div class="mb-5">
        <h4 class="text-success text-muted font-small">Checked-in Staff</h4>
        @if($checked_in_staff_today->count() > 0)
     <table id="staff-check-ins" class="table table-bordered table-striped table-hover border-2">
    <thead class="table-light">
        <tr>
            <th><small class="text-muted">Name</small></th>
            <th><small class="text-muted">Email</small></th>
            <th><small class="text-muted">Check-in Time</small></th>
            <th><small class="text-muted">Check-out Time</small></th>
         </tr>
    </thead>
    <tbody>
        @foreach($checked_in_staff_today as $staff)
            <tr>
                <td><small class="">{{ $staff->user->name }}</small></td>
                <td><small class="">{{ $staff->user->email }}</small></td>
                <td>
                    <span class="badge check-in-bg-badge"> <small>{{ \Carbon\Carbon::parse($staff->check_in_time)->format('g:i A') }}</small></span>
                </td>
                <td>
                    <span class="badge check-out-bg-badge"> <small>{{ \Carbon\Carbon::parse($staff->check_out_time)->format('g:i A') }}</small></span>
                </td>
            </tr>
        @endforeach
    </tbody>
    </table>

        @else
          <p>No staff have checked in today.</p>
        @endif
      </div>
  
   
      <div>
        <h4 class="text-muted">Checked-in Visitors</h4>
        @if(count($checked_in_visitors_today) > 0)
        <table id="visitors-check-ins" class="table table-bordered table-striped table-hover ">
            <thead>
                <tr>
                    <th><small class="text-muted">Name</small></th>
                    <th><small class="text-muted">Purpose of visit</small></th>
                    <th><small class="text-muted">Check-in Time</small></th>
                    <th><small class="text-muted">Check-out Time</small></th> 
                    <th><small class="text-muted">Action</small></th>
                </tr>
            </thead>
            <tbody>
                @foreach($checked_in_visitors_today as $visitor)
                    <tr>
                        <td><small>{{ ucwords(strtolower($visitor->visitor->name)) }}</small></td>
                        <td><small>{{ ucwords(strtolower($visitor->visitor->purpose_of_visit)) }}</small></td>
                        <td>
                            <span class="badge check-in-bg-badge"> <small>{{ \Carbon\Carbon::parse($visitor->check_in_time)->format('g:i A') }}</small></span>
                        </td>
                        <td>
                            @if($visitor->check_out_time)
                                <span class="badge check-out-bg-badge"> <small>{{ \Carbon\Carbon::parse($visitor->check_out_time)->format('g:i A') }}</small></span>
                            @else
                                <span class="badge text-warning">Still in Office</span>
                            @endif
                        </td>
                        <td>
                            @if($visitor->check_out_time)
                                <!-- If checked out, disable the button -->
                                <button type="button" class="btn btn-sm btn-outline-danger" disabled>Checked Out</button>
                            @else
                                <!-- Form for checking out -->
                                <form method="POST" action="{{ route('check-visitor-out', $visitor->id) }}" class="w-0">
                                    @method('PATCH')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Checkout</button>
                                </form>
                            @endif
                        </td>  
                    </tr>
                @endforeach
            </tbody>
        </table>
        @else
            <p>No visitors have checked in today.</p>
        @endif
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
                    color = 'rgba(255, 70, 70, 0.7)'; // Darker light red for low count
                } else if (value < 30) {
                    color = 'rgba(255, 140, 0, 0.7)'; // Darker orange for medium count
                } else {
                    color = 'rgba(0, 150, 150, 0.7)'; // Darker teal for high count
                }
                return color;
            },
            borderColor: function(context) {
                const value = context.dataset.data[context.dataIndex];
                let borderColor;
                if (value < 20) {
                    borderColor = 'rgba(255, 70, 70, 1)'; // Darker red for low count
                } else if (value < 30) {
                    borderColor = 'rgba(255, 140, 0, 1)'; // Darker orange for medium count
                } else {
                    borderColor = 'rgba(0, 150, 150, 1)'; // Darker teal for high count
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

<script>
  document.addEventListener('DOMContentLoaded', function () {
      var ctx = document.getElementById('dashboardPieChart').getContext('2d');
 
  });


</script>
@endsection

