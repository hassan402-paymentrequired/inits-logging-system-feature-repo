<div class="container">
  <h2>Edit {{ ucfirst($type) }}</h2>
  <form action="{{ route($type === 'visitor' ? 'visitors.update' : 'staffs.update', $person->id) }}" method="POST">
      @csrf
      @method('POST')

      <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control" id="name" name="name" value="{{ $person->name }}" required>
      </div>

      @if ($type === 'visitor')
          <div class="mb-3">
              <label for="phone_number" class="form-label">Phone Number</label>
              <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $person->phone_number }}" required>
          </div>

          <div class="mb-3">
              <label for="purpose_of_visit" class="form-label">Purpose of Visit</label>
              <input type="text" class="form-control" id="purpose_of_visit" name="purpose_of_visit" value="{{ $person->purpose_of_visit }}" required>
          </div>

          <div class="mb-3">
              <label for="age" class="form-label">Age</label>
              <input type="number" class="form-control" id="age" name="age" value="{{ $person->age }}" required>
          </div>
      @elseif ($type === 'staff')
          <div class="mb-3">
              <label for="position" class="form-label">Position</label>
              <input type="text" class="form-control" id="position" name="position" value="{{ $person->position }}" required>
          </div>

          <div class="mb-3">
              <label for="department" class="form-label">Department</label>
              <input type="text" class="form-control" id="department" name="department" value="{{ $person->department }}" required>
          </div>

          <div class="mb-3">
              <label for="phone_number" class="form-label">Phone Number</label>
              <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $person->phone_number }}" required>
          </div>
      @endif

      <button type="submit" class="btn btn-primary">Update {{ ucfirst($type) }}</button>
  </form>
</div>
