<div class="modal fade" id="addVisitorModal" tabindex="-1" aria-labelledby="addVisitorModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="addVisitorModalLabel">Add New Visitor</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <form id="visitorForm" action="{{ route('add-visitors') }}" method="POST">
                  @csrf

                  <div class="mb-3">
                      <label for="name" class="form-label">Name</label>
                      <input type="text" class="form-control" id="name" name="name" required>
                  </div>
                  <div class="mb-3">
                      <label for="phoneNumber" class="form-label">Phone Number</label>
                      <input type="tel" class="form-control" id="phoneNumber" name="phone_number" required>
                  </div>
                  <div class="mb-3">
                      <label for="purposeOfVisit" class="form-label" id="purposeLabel">Purpose of Visit</label>
                      <input type="text" class="form-control" id="purposeOfVisit" name="purpose_of_visit" required>
                  </div>
                  <div class="mb-3" id="staffSelectContainer" style="display: none;">
                      <label for="staffSelect" class="form-label">Select Staff</label>
                      <select class="form-select" id="staffSelect" name="staff">
                          <option value="" disabled selected>Select a staff member</option>
                          
                          @foreach($data as $item)
                              @foreach($item->users as $user)
                                  <option value="{{ $user->email }}">{{ $user->name }}</option>
                              @endforeach
                          @endforeach
                      </select>
                  </div>
          </div>
          <div class="modal-footer">
              <button type="submit" class="btn btn-primary" id="submitButton">Check-in</button>
          </div>
      </form>
      </div>
  </div>
</div>

  
  {{--  <script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('addVisitorModal');
        modal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget; // Button that triggered the modal
            const modalType = button.getAttribute('data-modal-type'); // Extract info from data-* attributes
            
            const title = modal.querySelector('.modal-title');
            const purposeLabel = modal.querySelector('#purposeLabel');
            const staffSelectContainer = modal.querySelector('#staffSelectContainer');
  
            if (modalType === 'staff') {
                title.textContent = 'Add New Staff';
                purposeLabel.textContent = 'Position';
                staffSelectContainer.style.display = 'none'; // Hide staff select for staff modal
            } else {
                title.textContent = 'Add New Visitor';
                purposeLabel.textContent = 'Purpose of Visit';
                staffSelectContainer.style.display = 'block'; // Show staff select for visitor modal
            }
        });
  
        document.getElementById('submitVisitor').addEventListener('submit', function () {
            const name = document.getElementById('name').value;
            const phoneNumber = document.getElementById('phoneNumber').value;
            const purposeOfVisit = document.getElementById('purposeOfVisit').value;
            const staffId = document.getElementById('staffSelectContainer').style.display === 'block' ? 
                            document.getElementById('staffSelect').value : null;
  
            // Perform the action (e.g., AJAX request) here
            console.log(name, phoneNumber, purposeOfVisit, staffId);
        });
    });
  </script>
    --}}

    <script>
      document.addEventListener('DOMContentLoaded', function () {
          const modal = document.getElementById('addVisitorModal');
          modal.addEventListener('show.bs.modal', function (event) {
              const button = event.relatedTarget; // Button that triggered the modal
              const modalType = button.getAttribute('data-modal-type'); // Get the modal type from data-* attribute
      
              const title = modal.querySelector('.modal-title');
              const purposeLabel = modal.querySelector('#purposeLabel');
              const staffSelectContainer = modal.querySelector('#staffSelectContainer');
              const submitButton = modal.querySelector('#submitButton');
      
              if (modalType === 'staff') {
                  // If the type is 'staff', change the modal title and button text, and hide staff select
                  title.textContent = 'Add New Staff';
                  purposeLabel.textContent = 'Position';
                  staffSelectContainer.style.display = 'none'; // Hide the staff select dropdown
                  submitButton.textContent = 'Add Staff'; // Change button text to 'Add Staff'
              } else {
                  // If the type is 'visitor', change the modal title and button text, and show staff select
                  title.textContent = 'Add New Visitor';
                  purposeLabel.textContent = 'Purpose of Visit';
                  staffSelectContainer.style.display = 'block'; // Show the staff select dropdown
                  submitButton.textContent = 'Check-in'; // Change button text to 'Check-in'
              }
          });
      });
      </script>
      