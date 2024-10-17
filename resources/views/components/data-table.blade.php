
<div class="card p-0 border border-success border-2">
    <div class="card-header bg-white p-4">
        
        @if (session('error') || session('success'))
        <p class="alert alert-success">{{ session('error') }}</p>
        <p class="alert alert-success" role="alert">{{ session('success') }}</p>
        @endif
        <div>
            <h5 class="card-title">{{ ucfirst($type) }} List</h5>
            <small class="text-secondary fw-semibold">Details & History</small>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ request()->url() }}" method="GET" class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">
            <div class="datatable-top d-flex justify-content-between align-items-center mb-3">
                <div class="datatable-dropdown">
                    <label class="d-flex align-items-center gap-2">
                        <select name="per_page" class="form-select datatable-selector" style="width: 5rem; cursor: pointer;" onchange="this.form.submit()">
                            <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                            <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                            <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15</option>
                            <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                        </select>
                        <small>entries per page</small>
                    </label>
                </div>
                <div class="datatable-search position-relative">
                    <i class="bi bi-search position-absolute text-primary" style="left: 10px; top: 50%; transform: translateY(-50%);"></i>
              
                  
                        <input type="text" id="searchInput" class="form-control  ps-5" placeholder="Search visitor's name..." onkeyup="searchTable()"    aria-controls="datatablesSimple">
                  
                    
                </div>
            </div>

            <div class="datatable-container">
               
                <table class="table table-bordered table-striped table-hover" id="datatablesSimple">
                    <thead>
                        <tr class="p-4">
                            @if($type === 'visitors')
                                <th data-sortable="true"><small class="fw-semibold text-muted">Name</small></th>
                                <th data-sortable="true"><small class="fw-semibold text-muted">Phone Number</small></th>
                                <th data-sortable="true"><small class="fw-semibold text-muted">Purpose of Visit</small></th>
                                <th data-sortable="true"><small class="fw-semibold text-muted">Host/staff</small></th>
                            @elseif($type === 'staffs')
                                <th data-sortable="true"><small class="fw-semibold text-muted">Name</small></th>
                                <th data-sortable="true"><small class="fw-semibold text-muted">Email</small></th>
                                <th data-sortable="true"><small class="fw-semibold text-muted">Phone Number</small></th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $item)
                            <tr class="p-4">
                                @if($type === 'visitors')
                                    <td>
                                            <small class="fw-normal">{{ $item->visitor->name }}</small>
                                    </td>
                                    <td>
                                   
                                            <small class="fw-normal">{{ $item->visitor->phone_number }}</small>
                                    
                                    </td>
                                    <td>
                                            <small class="fw-normal">{{ $item->visitor->purpose_of_visit }}</small>
                                    </td>
                                    <td class="text-">{{ $item->visitor->user->name }}</td>
                                @elseif($type === 'staffs')
                                    <td>
                                        <a href="{{ route('update.staff.data', $item->id) }}" class="text-decoration-none text-muted" data-bs-toggle="tooltip" title="View Staff">
                                            <small>{{ $item->name }}</small>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('update.staff.data', $item->id) }}" class="text-decoration-none text-muted" data-bs-toggle="tooltip" title="View Staff">
                                            <small>{{ $item->email }}</small>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('update.staff.data', $item->id) }}" class="text-decoration-none text-muted" data-bs-toggle="tooltip" title="View Staff">
                                            <small>{{ $item->phone_number }}</small>
                                        </a>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="datatable-bottom d-flex justify-content-between align-items-center mt-3">
                <div class="datatable-info">
                    Showing {{ $data->firstItem() }} to {{ $data->lastItem() }} of {{ $data->total() }} entries
                </div>
                <nav class="datatable-pagination">
                    {{ $data->links('pagination::bootstrap-4') }}
                </nav>
            </div>
        </form>
    </div>
</div>



<script>
    function searchTable() {
        const input = document.getElementById('searchInput');
        const filter = input.value.toLowerCase();
        const table = document.getElementById('datatablesSimple');
        const rows = table.getElementsByTagName('tr');

        // Loop through all table rows, excluding the header
        for (let i = 1; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName('td');
            let rowContainsSearchTerm = false;

            // Loop through each cell in the row
            for (let j = 0; j < cells.length; j++) {
                const cellText = cells[j].textContent || cells[j].innerText;
                // Check if the cell contains the search term
                if (cellText.toLowerCase().indexOf(filter) > -1) {
                    rowContainsSearchTerm = true;
                    break; // No need to check other cells if one matches
                }
            }

            // Show or hide the row based on the search term
            if (rowContainsSearchTerm) {
                rows[i].style.display = ''; // Show row
            } else {
                rows[i].style.display = 'none'; // Hide row
            }
        }
    }
</script>