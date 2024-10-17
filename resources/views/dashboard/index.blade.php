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
<x-breadcrumb title="Admin Dashboard" :items="[
    ['name' => 'Dashboard', 'url' => '#', 'active' => false],
    ['name' => 'Home', 'url' => '#', 'active' => true],
]" />

<x-modal-button   visitorsModel='addVisitorModalLabel' modalType="visitor" icon="bi bi-person-plus" />
</div>


 <x-modal  route="add.visitors" :data="$staffs" visitorsModel='addVisitorModalLabel' modalType="visitor" /> 

<div class="d-flex flex-column flex-md-row align-items-center w-100 mb-3">
  <small class="text-muted mb-2 mb-md-0 me-md-3">
    Visitor/Staffs checkins overview & summary for: 
   <span class="text-muted fw-semibold fst-italic"> {{ \Carbon\Carbon::parse($selectedDate)->format('F j, Y') }}</small>
</span>
  {{-- Date Picker Form --}}
  <form action="{{ route('admin.dashboard') }}" method="GET" class="ms-md-auto">
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
    title="Overall check-ins"
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
    title="Total staffs"
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
    title="Total visitors"
    chartIcon="bi-people-fill"
    chartIconColor="text-dark"
 
/>


{{-- Analytics Overview (Heat Chart for Busiest Week) --}}
<div class="container">
  <div class="row mb-4">
      <div class="col-lg-8 mb-3">
          <div class="card card-raised">
              <div class="card-header bg-transparent p-4">
                  <h5><small>Busiest days for this week</small></h5>
              </div>
              <div class="card-body">
                  <canvas id="busiestWeekChart" style="height: 200px;"></canvas>
              </div>
              <div class="card-footer p-3 d-flex bg-white">
                <a href="" class="report-link ms-auto">OPEN REPORT<i class="bi bi-arrow-right"></i></a>
            </div>
          </div>
      </div>

        
            <div class="col-lg-4">
                <div class="card card-raised ">
                    <div class="card-header bg-transparent p-4">
                        <h6 class="card-title fw-normal"><small>Staff Check-ins for current day</small></h6>
                        <select id="recent&oldestFilter" class="form-select ms-auto border border-success" aria-label="Filter visitors">
                            <option value="Recent">Recent</option>
                            <option value="Oldest">Oldest</option>
                        </select>
                    </div>
                    <div id="recent&oldestdata" class="card-body p-4">
                        <!-- Display the data based on the selected filter -->
                        @if ($recent_checked_in_staff->isEmpty() && $oldest_checked_in_staff->isEmpty())
                            <p>No staff have checked in recently.</p>
                        @else
                            <div class="container p-0">
                                <div class="row mb-2 custom-border-bottom p-0">
                                    <div class="col-4 fw-bold d-flex align-items-center justify-content-center">
                                        <i class="bi-person-workspace text-primary fs-4"></i>
                                    </div>
                                    <div class="col-4 fw-bold d-flex align-items-center justify-content-center">
                                        <i class="bi bi-geo-fill text-danger fs-4"></i>
                                    </div>
                                    <div class="col-4 fw-bold d-flex align-items-center justify-content-center">
                                        <i class="bi bi-clock-history text-success fs-4"></i>
                                    </div>
                                </div>
                                
                                <!-- Recent Check-ins -->
                                <div id="recent-checkins" class="staff-checkins">
                                    @foreach ($recent_checked_in_staff as $staffCheckIn)
                                        <div class="row mb-2 recent">
                                            <div class="col-4">
                                            <a href="" class="">
                                                <small>{{ ucwords($staffCheckIn->user->name) }}</small>
                                        </a>
                                            
                                            </div>


                                            <div class="col-4 text-muted">
                                                <small>
                                                    <span 
                                                    class="{{ $staffCheckIn->check_out_time ? 
                                                    'checked-out-status' : 
                                                    'in-office-status'}}">

                                                    </span>
                                                    {{ $staffCheckIn->check_out_time ? 'Checked out' : 'On site' }}
                                                </small>

                                            </div>

                                            <div class="col-4 d-flex align-items-center justify-content-center text-muted">
                                                <small>{{ \Carbon\Carbon::parse($staffCheckIn->check_in_time)->format('g:i A') }}</small>
                                            </div>
                                      
                                        </div>
                                    @endforeach
                                </div>
                
                                <!-- Oldest Check-ins -->
                                <div id="oldest-checkins" class="staff-checkins" style="display: none;">
                                    @foreach ($oldest_checked_in_staff as $staffCheckIn)
                                        <div class="row mb-2 oldest">
                                            <div class="col-4"><small>{{ $staffCheckIn->user->name }}</small></div>
                                            <div class="col-4 text-muted"><span class="in-office-status"></span> <small>On site</small></div>
                                            <div class="col-4 d-flex align-items-center justify-content-center text-muted">
                                                <small>{{ \Carbon\Carbon::parse($staffCheckIn->check_in_time)->format('g:i A') }}</small>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <!-- Modal for All Staff Check-ins -->
                                <div class="modal fade" id="allStaffModal" tabindex="-1" aria-labelledby="allStaffModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content border border-primary border-2">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="allStaffModalLabel">All Staff Check-ins for Today</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body" style="max-height: 30rem; overflow-y: auto;">
                                                <div class="mb-3 position-relative">
                                                    <i class="bi bi-search position-absolute text-primary" style="left: 10px; top: 50%; transform: translateY(-50%);"></i>
                                                    <input type="text" id="staffSearch" class="form-control ps-5" placeholder="Search for staff..." onkeyup="filterStaff()">
                                                    
                                                </div>
                                                <!-- Modal content: Display staff check-ins -->
                                                <div class="container">
                                                    <div class="row mb-2">
                                                        <div class="col-4 fw-bold d-flex align-items-center justify-content-center">
                                                            <i class="bi-person-workspace text-primary fs-4"></i>
                                                        </div>
                                                        <div class="col-4 fw-bold d-flex align-items-center justify-content-center">
                                                            <i class="bi bi-geo-fill text-danger fs-4"></i>
                                                        </div>
                                                        <div class="col-4 fw-bold d-flex align-items-center justify-content-center">
                                                            <i class="bi bi-clock-history text-success fs-4"></i>
                                                        </div>
                                                    </div>
                                                    <div class="staff-checkins-list">
                                                        @foreach ($staffs_for_today as $staffCheckIn)
                                                            <div class="row mb-2 staff-row recent">
                                                                <div class="col-4">{{ $staffCheckIn->user->name }}</div>
                                                                <div class="col-4 text-muted"> 
                                                                    <small>
                                                                        <span 
                                                                        class="{{ $staffCheckIn->check_out_time ? 
                                                                        'checked-out-status' : 
                                                                        'in-office-status'}}">

                                                                        </span>
                                                                        {{ $staffCheckIn->check_out_time ? 'Checked out' : 'On site' }}
                                                                    </small>

                                                                </div>
                                                                <div class="col-4 d-flex align-items-center justify-content-center text-muted">
                                                                    {{ \Carbon\Carbon::parse($staffCheckIn->check_in_time)->format('g:i A') }}
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <div id="noStaffMessage" class="text-danger" style="display: none;">
                                                        No staff members found.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="card-footer p-3 d-flex bg-white">
                        <a  type="button" class="btn  btn-outline-primary mt-3 report-link ms-auto" data-bs-toggle="modal" data-bs-target="#allStaffModal" >VIEW All <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            
        </div>
      </div>
  </div>

  <div id="total-check-ins" class="bg-light border border-success border-2 py-5">
    <div class="container">
      <h3 class="text-center mb-5 font-small fw-normal">Visitors for {{ \Carbon\Carbon::parse($selectedDate)->format('F j, Y') }}</h3>
      

      <div class="d-flex align-items-center  mb-3">
        <div class="position-relative">
            <i class="bi bi-search position-absolute text-primary" style="left: 10px; top: 50%; transform: translateY(-50%);"></i>
            <input type="text" id="visitorSearch" class="form-control ps-5" placeholder="Search for visitors..." onkeyup="filterVisitors()">
        </div>
        <!-- Dropdown Filter -->
       
            <select id="visitorFilter" class="form-select w-25 ms-auto  border border-success" aria-label="Filter visitors">
                <option value="all">All Visitors</option>
                <option value="in-office">Still on site</option>
                <option value="checked-out">Checked Out</option>
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
                @session('error')
                    {{ session('error') }}
                @endsession 
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
                                    <button type="button" class="btn btn-sm btn-outline-danger" disabled><i class="bi bi-exclamation-diamond"></i></button>
                                @else
                                    <form method="POST" action="{{ route('check.visitor.out', $visitor->visitor->id) }}" class="w-0">
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
        <div id="noVisitorsMessage" class="text-danger" style="display: none;">
            No visitors found.
        </div>
    </div>
    </div>
        {{-- Include Scroll Up Button Component --}}
        <x-scroll-up-button />
</div>

{{-- Chart.js Script for Heat Chart --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('busiestWeekChart').getContext('2d');
        const busiestWeekChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($weekDays) !!}, // Days of the week from controller
                datasets: [{
                    label: 'Check-Ins',
                    data: {!! json_encode($checkInCounts) !!}, // Daily check-in counts from controller
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

<script>
    document.getElementById('recent&oldestFilter').addEventListener('change', function() {
        const filterValue = this.value;
        const recentCheckins = document.getElementById('recent-checkins');
        const oldestCheckins = document.getElementById('oldest-checkins');

        if (filterValue === 'Recent') {
            recentCheckins.style.display = 'block'; // Show recent check-ins
            oldestCheckins.style.display = 'none';   // Hide oldest check-ins
        } else if (filterValue === 'Oldest') {
            recentCheckins.style.display = 'none';   // Hide recent check-ins
            oldestCheckins.style.display = 'block';  // Show oldest check-ins
        }
    });
</script>

<script>
    function filterStaff() {
        // Get the value from the search input
        const input = document.getElementById('staffSearch');
        const filter = input.value.toLowerCase(); // Convert to lowercase for case-insensitive search
        const staffRows = document.querySelectorAll('.staff-row'); // Get all staff rows
        let hasVisibleRows = false; // Flag to check if there are visible rows

        // Loop through all staff rows
        staffRows.forEach(row => {
            const staffName = row.querySelector('.col-4').textContent.toLowerCase(); // Get staff name
            // Check if the name matches the filter
            if (staffName.includes(filter)) {
                row.style.display = ''; // Show the row
                hasVisibleRows = true; // Set the flag to true if a match is found
            } else {
                row.style.display = 'none'; // Hide the row
            }
        });

        // Show or hide the no staff message based on whether any rows are visible
        const noStaffMessage = document.getElementById('noStaffMessage');
        if (hasVisibleRows) {
            noStaffMessage.style.display = 'none'; // Hide the message if there are visible rows
        } else {
            noStaffMessage.style.display = ''; // Show the message if no rows are visible
        }
    }
</script>
<script>
    function filterVisitors() {
        const input = document.getElementById('visitorSearch');
        const filter = input.value.toLowerCase(); // Convert to lowercase for case-insensitive search
        const visitorRows = document.querySelectorAll('#visitorTableBody tr'); // Get all visitor rows
        let hasVisibleRows = false; // Flag to check if there are visible rows

        // Loop through all visitor rows
        visitorRows.forEach(row => {
            const visitorName = row.querySelector('td:nth-child(1)').textContent.toLowerCase(); // Get visitor name
            const purposeOfVisit = row.querySelector('td:nth-child(2)').textContent.toLowerCase(); // Get purpose of visit
            const phoneNumber = row.querySelector('td:nth-child(3)').textContent.toLowerCase(); // Get phone number

            // Check if the name, purpose of visit, or phone number matches the filter
            if (visitorName.includes(filter) || purposeOfVisit.includes(filter) || phoneNumber.includes(filter)) {
                row.style.display = ''; // Show the row
                hasVisibleRows = true; // Set the flag to true if a match is found
            } else {
                row.style.display = 'none'; // Hide the row
            }
        });

        // Show or hide the no visitors message based on whether any rows are visible
        const noVisitorsMessage = document.getElementById('noVisitorsMessage');
        if (hasVisibleRows) {
            noVisitorsMessage.style.display = 'none'; // Hide the message if there are visible rows
        } else {
            noVisitorsMessage.style.display = ''; // Show the message if no rows are visible
        }
    }
</script>




@endsection

