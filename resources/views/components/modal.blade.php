<!-- resources/views/components/modal.blade.php -->
<div class="modal fade" id="{{ $visitorsModel }}" tabindex="-1" aria-labelledby="{{ $visitorsModel }}Label" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content border border-primary border-2">
            <div class="modal-header">
                <h5 class="modal-title" id="{{ $visitorsModel }}Label">
                    @if ($modalType === 'staff')
                        Add New Staff
                    @else
                        Add New Visitor
                    @endif
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('add-visitors') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="phoneNumber" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" id="phoneNumber" name="phone_number" required>
                    </div>
                    @if ($modalType === 'staff')
                        <div class="mb-3">
                            <label for="position" class="form-label">email</label>
                            <input type="email" class="form-control" id="position" name="email" required>
                        </div>
                    @else
                        <div class="mb-3">
                            <label for="purposeOfVisit" class="form-label">Purpose of Visit</label>
                            <textarea class="form-control" id="purposeOfVisit" name="purpose_of_visit" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="staffSelect" class="form-label">Select Staff</label>
                            <select class="form-select" id="staffSelect" name="staff" required>
                                <option value="" disabled selected>Select a staff member</option>
                                @foreach($data as $item)
                                    <option value="{{ $item->email }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                            @if ($modalType === 'staff')
                                Add Staff
                            @else
                                Check-in
                            @endif
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
