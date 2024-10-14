@props(['href', 'active', 'icon'])

<li class="{{ $active ? 'active' : '' }}">
    <a href="{{ $href }}" {{ $attributes->merge(['aria-label' => $slot]) }}>
        <i class="bi {{ $icon }} m-2"></i>
        <span class="text m-2">{{ $slot }}</span>
    </a>
</li>
