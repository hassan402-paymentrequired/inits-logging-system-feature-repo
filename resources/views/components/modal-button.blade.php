<!-- resources/views/components/modal-button.blade.php -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#{{ $visitorsModel }}">
    <i class="{{ $icon }}"></i>
    @if ($modalType === 'staff')
        Add New Staff
    @else
        Add New Visitor
    @endif
</button>
