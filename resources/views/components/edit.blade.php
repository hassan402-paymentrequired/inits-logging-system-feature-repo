<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-lg-8 col-md-10 col-sm-12">
      <div class="card shadow-lg border-0 rounded-3">
        <div class="card-header text-center py-2 border border-primary border-2">
          <h3 class="mb-0">Edit {{ ucfirst($type) }}</h3>
        </div>
        <div class="card-body px-5 py-4 border border-primary border-2">
          <form id="editForm" action="{{ route($type === 'visitor' ? 'update-visitor-data' : 'update-staff-data', $person->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <!-- Name Field -->
            <div class="form-group mb-4">
              <label for="name" class="form-label fw-semibold">Name</label>
              <input type="text" class="form-control border-primary @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $person->name) }}" required placeholder="Enter full name">
              <!-- Error Message -->
              @error('name')
                <div class="text-danger mt-1">{{ $message }}</div>
              @enderror
            </div>

            <!-- Visitor Specific Fields -->
            @if ($type === 'visitor')
              <div class="form-group mb-4">
                <label for="phone_number" class="form-label fw-semibold">Phone Number</label>
                <input type="text" class="form-control border-primary @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" value="{{ old('phone_number', $person->phone_number) }}" required placeholder="Enter phone number">
                <!-- Error Message -->
                @error('phone_number')
                  <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group mb-4">
                <label for="purpose_of_visit" class="form-label fw-semibold">Purpose of Visit</label>
                <input type="text" class="form-control border-primary @error('purpose_of_visit') is-invalid @enderror" id="purpose_of_visit" name="purpose_of_visit" value="{{ old('purpose_of_visit', $person->purpose_of_visit) }}" required placeholder="Reason for visit">
                <!-- Error Message -->
                @error('purpose_of_visit')
                  <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
              </div>

            @elseif ($type === 'staff')
            <!-- Staff Specific Fields -->
            <div class="form-group mb-4">
              <label for="email" class="form-label fw-semibold">Email</label>
              <input type="email" class="form-control border-primary @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $person->email) }}" required placeholder="Enter email">
              <!-- Error Message -->
              @error('email')
                <div class="text-danger mt-1">{{ $message }}</div>
              @enderror
            </div>
            

              <div class="form-group mb-4">
                <label for="phone_number" class="form-label fw-semibold">Phone Number</label>
                <input type="text" class="form-control border-primary @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" value="{{ old('phone_number', $person->phone_number) }}" required placeholder="Enter phone number">
                <!-- Error Message -->
                @error('phone_number')
                  <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
              </div>
            @endif

            <!-- Submit Button -->
            <div class="d-flex">
              <a href="{{ $type === 'visitor' ? route('visitors') : route('staffs') }}" class="me-auto "><i class="bi bi-arrow-left"></i> BACK</a>
              <button id="editBtn" type="button" class="btn btn-primary shadow-sm ms-auto">Edit {{ ucfirst($type) }}</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.getElementById('editBtn').addEventListener('click', function(event) {
    event.preventDefault();  // Prevent default form submission
    Swal.fire({
      title: 'Are you sure?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, edit!'
    }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById('editForm').submit();  // Submit the form if confirmed
      }
    });
  });
</script>
