<!-- resources/views/components/breadcrumb.blade.php -->

    <div>
        <h1 class="h2">{{ $title }}</h1>
        <ul class="breadcrumb">
            @foreach ($items as $item)
                <li class="breadcrumb-item {{ $item['active'] ? 'active' : '' }}" aria-current="{{ $item['active'] ? 'page' : '' }}">
                    @if ($item['active'])
                        {{ $item['name'] }}
                    @else
                        <a href="{{ $item['url'] }}">{{ $item['name'] }}</a>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>

