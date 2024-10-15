<div class="mb-3">
  <div class="d-flex justify-content-between">
      <div>
          <select id="monthFilter" class="form-select form-select-sm">
              <option value="">Filter by Month</option>
              @foreach (['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                  <option value="{{ $month }}">{{ $month }}</option>
              @endforeach
          </select>
      </div>
      <div class="input-group mb-2 w-25">
          <span class="input-group-text">
              <i class="bi bi-search text-primary"></i>
          </span>
          <input type="text" id="nameSearch" class="form-control form-control-sm" placeholder="Search visitors name...">
      </div>
  </div>
</div>
