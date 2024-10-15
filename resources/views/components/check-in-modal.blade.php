<div class="modal fade" id="checkInModal" tabindex="-1" aria-labelledby="checkInModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="checkInModalLabel">{{ $title }}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <div id="modal-content-area">
                  @if (count($staff) > 0)
                      <h6>Checked-in Staff:</h6>
                      <ul>
                          @foreach ($staff as $staffMember)
                              <li>{{ $staffMember['name'] }} - {{ $staffMember['position'] }}</li>
                          @endforeach
                      </ul>
                  @else
                      <p>No checked-in staff for today.</p>
                  @endif

                  @if (count($visitors) > 0)
                      <h6>Checked-in Visitors:</h6>
                      <ul>
                          @foreach ($visitors as $visitor)
                              <li>{{ $visitor['name'] }} - {{ $visitor['purpose'] }}</li>
                          @endforeach
                      </ul>
                  @else
                      <p>No checked-in visitors for today.</p>
                  @endif
              </div>
          </div>
      </div>
  </div>
</div>
