
<div class="d-flex justify-content-between align-items-center">
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
  @component('components.button', [
    'id' => $buttonmodalId,
    'type' => $buttonType,
    'icon' => $buttonIcon,
    'text' => $buttonText,
    'dataModelType'=> $buttonModelType,
    'dataToggle' => 'modal',
    'dataTarget' => $buttonmodalId // Ensure this matches your modal ID
])
@endcomponent
</div>
