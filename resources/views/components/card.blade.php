@props([
    'borderColor' => 'border-primary',
    'colorClass' => 'shalow-blue',
    'icon' => 'bi-binoculars',
    'iconColor' => 'text-primary',
    'toolTipTitle' => '',
    'count' => 0,
    'countsColor' => 'text-dark',
    'title' => '',
    'chartIcon' => '',
    'chartIconColor' => '',

])


<div id="card" class="col-12 col-md-6 col-lg-4 mb-3">
    <div class="{{ $borderColor }} card dashboard-card border-start bg-white border border-4" style="cursor: pointer">
        <a type="button" class="btn w-100" data-bs-toggle="modal" data-bs-target="#myLargeModal">
        <div class="card-body d-flex align-items-center"
            data-bs-toggle="tooltip"
            data-bs-placement="top"
            title="{{ $toolTipTitle }}">
            <div class="{{ $colorClass }} p-4 me-1 d-flex align-items-center justify-content-center rounded">
                <i class="bi {{ $icon }} {{ $iconColor }}"></i>
            </div>
            <div class="d-flex flex-column">
                <div class="d-flex align-items-start gap-2">
                    <h4 class="fw-normal mt-2 {{ $countsColor }}">{{ $count }}</h4>
                    <i class="bi {{ $chartIcon }} {{ $chartIconColor }} fs-5 mt-1 fw-normal"></i>
                 
                </div>
                <small class="small-font ms-1 text-secondary">{{ $title }}</small>
                <small class="small-font ms-1 text-secondary fw-small">for today</small>
            </div>
        
         <i class="bi bi-binoculars-fill {{ $iconColor }} ms-auto mb-5"></i>
        </div>
    </a>
    </div>
</div>
