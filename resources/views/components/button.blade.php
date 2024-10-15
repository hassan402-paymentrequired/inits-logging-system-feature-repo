<button type="{{ $type }}" id="{{ $id }}" class="btn btn-primary" 
    data-bs-toggle="{{ $dataToggle }}"
    data-modal-type="{{ $dataModelType }}" 
    data-bs-target="{{ $dataTarget }}">
    @if(!empty($icon))
        <i class="{{ $icon }}"></i>
    @endif
    {{ $text }}
</button>