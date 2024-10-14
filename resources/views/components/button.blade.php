{{--  resources/views/components/Button.blade.php
<button type="button" class="btn btn-primary"  dataToggle"={{ $type }}" dataTarget="{{ $Id }}">
  <i class="{{ $icon }}"></i>
  <span class="text">{{ $text }}</span>
</button>  --}}

<button type="{{ $type }}" id="{{ $id }}" class="btn btn-primary" 
    data-bs-toggle="{{ $dataToggle }}"
    data-modal-type="{{ $dataModelType }}" 
    data-bs-target="{{ $dataTarget }}">
    @if(!empty($icon))
        <i class="{{ $icon }}"></i>
    @endif
    {{ $text }}
</button>