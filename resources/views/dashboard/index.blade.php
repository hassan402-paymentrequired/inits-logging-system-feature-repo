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

<div class="d-flex justify-content-between align-items-center">
<x-breadcrumb title="Dashboard" :items="[
    ['name' => 'Dashboard', 'url' => '#', 'active' => false],
    ['name' => 'Home', 'url' => '#', 'active' => true],
]" />


<x-modal-button visitorsModel='addVisitorModalLabel' modalType="visitor" icon="bi bi-person-plus" />
</div>

{{--  .blade  --}}
 <x-modal :data="$staffs" visitorsModel='addVisitorModalLabel' modalType="visitor" /> 


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
    toolTipTitle="View all staffs and Visitors for the day"
    count="{{ count($checked_in_staff_today) + count($checked_in_visitors_today) }}"
    countsColor="text-success"
    title="Overall"
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
    toolTipTitle="View all Staffs for the day"
    count="{{ count($checked_in_staff_today) }}"
    countsColor="text-primary"
    title="Staffs"
    chartIcon="bi-person-workspace"
    chartIconColor="text-primary"

/>

<x-card
    target="#visitors-check-ins"
    borderColor="border-secondary"
    colorClass="shalow-dark"
    icon="bi-people-fill"
    iconColor="text-dark"
    toolTipTitle="View all Visitors for the day"
    count="{{ count($checked_in_visitors_today) }}"
    countsColor="text-success"
    title="Visitors"
    chartIcon="bi-people-fill"
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
                  <h5 class="card-title fw-normal"><small>Recently Checked-in Staff</small></h5>
            
                </div>
                <div class="card-body p-4">
              
                </div>
                <div class="card-footer p-3 d-flex bg-white">
                  <a href="" class="report-link ms-auto">VIEW MORE<i class="bi bi-arrow-right"></i></a>
              </div>
              </div>
            </div>
        </div>
      </div>
  </div>

  <div id="total-check-ins" class="bg-light border border-success border-2 py-5">
    <div class="container">
      <h3 class="text-center mb-5 font-small fw-normal">Activities for {{ \Carbon\Carbon::parse($selectedDate)->format('F j, Y') }}</h3>
      

      <div class="d-flex align-items-center mb-3">
        <h4 class="text-secondary font-small">Visitors</h4>
    
        <!-- Dropdown Filter -->
       
            <select id="visitorFilter" class="form-select w-25 ms-auto border border-success" aria-label="Filter visitors">
                <option value="all">All Visitors</option>
                <option value="in-office">Still in Office</option>
                <option value="checked-out">Check Out</option>
            </select>
        </div>
    
        <table id="visitors-check-ins" class="table table-bordered table-striped table-hover ">
            @if(count($checked_in_visitors_today) > 0)
                <thead>
                    <tr>
                        <th><small class="text-muted">Name</small></th>
                        <th><small class="text-muted">Purpose of visit</small></th>
                        <th><small class="text-muted">Contact address</small></th>
                        <th><small class="text-muted">Status</small></th>
                        <th><small class="text-muted">Action</small></th>
                    </tr>
                </thead>
                <tbody id="visitorTableBody">
                    @foreach($checked_in_visitors_today as $visitor)
                        @php
                            $checkInTime = \Carbon\Carbon::parse($visitor->created_at)->format('g:i A');
                            $checkOutTime = $visitor->check_out_time ? \Carbon\Carbon::parse($visitor->check_out_time)->format('g:i A') : 'Still in Office';
                            $tooltip = "Check-in: $checkInTime | Check-out: $checkOutTime";
                        @endphp
    
                        <tr data-toggle="tooltip" data-placement="top" title="{{ $tooltip }}" class="{{ $visitor->check_out_time ? 'checked-out' : 'still-in-office' }}">
                            <td><small>{{ ucwords(strtolower($visitor->visitor->name)) }}</small></td>
                            <td><small>{{ ucwords(strtolower($visitor->visitor->purpose_of_visit)) }}</small></td>
                            <td>
                                <small class="text-muted">{{ $visitor->visitor->phone_number }}</small>
                            </td>
                            <td>
                                <small><span class="{{ $visitor->check_out_time ? 'checked-out-status' : 'in-office-status' }}"></span>
                                    {{ $visitor->check_out_time ? 'Checked out' : 'On site' }}</small>
                            </td>
                            <td>
                                @if($visitor->check_out_time)
                                    <button type="button" class="btn btn-sm btn-outline-danger px-4" disabled><i class="bi bi-exclamation-diamond"></i></button>
                                @else
                                    <form method="POST" action="{{ route('check-visitor-out', $visitor->visitor->id) }}" class="w-0">
                                        @method('PATCH')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Checkout</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            @else
                <p>No visitors have checked in today.</p>
            @endif
        </table>
    </div>
    </div>
        {{-- Include Scroll Up Button Component --}}
        <x-scroll-up-button />
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
      position: 'center',
      timer: 3000,
      timerProgressBar: true,
      showConfirmButton: false
  });
  @endif
</script>
<script>
  document.getElementById('visitorFilter').addEventListener('change', function() {
        const filterValue = this.value;
        const rows = document.querySelectorAll('#visitorTableBody tr');
        rows.forEach(row => {
            if (filterValue === 'all') {
                row.style.display = ''; // Show all visitors
            } else if (filterValue === 'in-office') {
                row.style.display = row.classList.contains('still-in-office') ? '' : 'none'; // Show only still in office visitors
            } else if (filterValue === 'checked-out') {
                row.style.display = row.classList.contains('checked-out') ? '' : 'none'; // Show only checked out visitors
            }
        });
    });
</script>



@endsection

