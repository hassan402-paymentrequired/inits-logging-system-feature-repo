@extends('layouts.main-layout')

@section('title', 'Staffs')

@section('main-content')

    <div class="accordion" id="accordionExample">

      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            Accordion Item #1
          </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            Accordion Item #2
          </button>
        </h2>
        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
            Accordion Item #3
          </button>
        </h2>
        <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
          </div>
        </div>
      </div>
=======
    <x-breadcrumb title="Staff/ OPeyemi" :items="[ 
        ['name' => 'Staff', 'url' => '#', 'active' => false],
        ['name' => 'Overview', 'url' => '#', 'active' => true],
    ]" />

    <div class="d-flex align-items-center mb-3">
        <select id="recent&oldestFilter" class="form-select border border-success w-25 me-auto" aria-label="Filter visitors">
            <option value="Recent">Recent</option>
            <option value="Oldest">Oldest</option>
        </select>
        
        <input type="date" class="form-control text-primary ms-auto w-25" name="selected_date" required />
        <button class="btn btn-sm btn-secondary" type="submit">Select Date</button>
>>>>>>> f64d29f2674ba2dd381b3244b579907c62abba41
    </div>

    <div class="card p-0">
        <div class="card-header bg-transparent d-flex flex-column">
            <h5 class="mb-0">Weeks of the month</h5> <small class="text-muted font-small fw-semibold">Working days</small>
         
           <div class="d-flex flex-column mt-3 gap-1"> 
            <span class=" fw-normal">Days present:  <span class="in-office-status" ></span></span> 
            <span class=" fw-normal">Days absent:  <span class="checked-out-status" ></span></span>
           </div>
        </div>
        <div class="card-body">
            <div class="accordion" id="accordionPanelsStayOpenExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                            Week 1
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                        <div class="accordion-body">
                          <div class="d-flex align-items-center gap-5 p-3 ms-5">
                            <small>
                              <span class="in-office-status" ></span>
                           Monday
                          </small>
                          <small>
                            <span class="in-office-status" ></span>
                          Tuesday
                        </small>
                        <small>
                          <span class="checked-out-status" ></span>
                       Wednesday
                      </small>
                      <small>
                        <span class="in-office-status" ></span>
                   Thursday
                    </small>
                    <small>
                      <span class="checked-out-status" ></span>
               Friday
                  </small>
                          </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                          Week 2
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                        <div class="accordion-body">
                          <div class="px-4 ms-5">
                            <small>
                              <span class="checked-out-status" ></span>
                              monday
                          </small>
                          </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                          Week 3
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
                        <div class="accordion-body">
                          <div class="px-4 ms-5">
                            <small>
                              <span class="checked-out-status" ></span>
                              monday
                          </small>
                          </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false" aria-controls="panelsStayOpen-collapseFour">
                        Week 4
                      </button>
                  </h2>
                  <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse">
                      <div class="accordion-body">
                        <div class="px-4 ms-5">
                          <small>
                            <span class="checked-out-status" ></span>
                            monday
                        </small>
                        </div>
                      </div>
                  </div>
              </div>
            </div>
        </div>
    </div>

@endsection
