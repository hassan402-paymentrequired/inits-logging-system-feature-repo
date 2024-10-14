

<div class="col-12 col-md-6 col-lg-4 mb-3">
    <div class=" {{ $borderColor }} card dashboard-card border-start bg-white border border-4" style="cursor: pointer">
        <div class="card-body d-flex align-items-center">
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
        </div>
    </div>
  </div>
