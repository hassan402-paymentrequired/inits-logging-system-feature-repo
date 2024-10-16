<section id="sidebar" class="d-flex flex-column align-items-start ">
    <a href="#" class="brand p-2 m-4">
        <img src="{{ asset('build/assets/Logo (1).png') }}" alt="Logo" class="w-75" />
    </a>
    <ul class="side-menu top">
      <x-nav-link href="{{ route('admin.dashboard') }}" icon="bi-house-door" :active="request()->is('v1/admin/dashboard')">Dashboard</x-nav-link>
      <x-nav-link href="{{ route('visitors') }}" icon="bi-people-fill" :active="request()->is('v1/visitors')">Visitors</x-nav-link>
      <x-nav-link href="{{ route('staffs') }}" icon="bi-person-workspace" :active="request()->is('v1/staffs')">Staffs</x-nav-link>
      <x-nav-link href="{{ route('geofencing') }}" icon="bi-geo-alt-fill" :active="request()->is('v1/geofencing')">Geofencing</x-nav-link>
    </ul>
    <ul class="side-menu">
      <li>
        <form id="logoutForm" action="{{ route('logout') }}" method="post" style="display: inline;">
          @csrf
          <button id="submitButton" type="button" class="logout btn">
            <i class="bi bi-box-arrow-right text-danger m-2"></i>
            <span class="text-danger m-2">Logout</span>
          </button>
        </form>
      </li>
    </ul>
  </section>
  
  <script>
    document.getElementById('submitButton').addEventListener('click', function() {
      Swal.fire({
        title: 'Are you sure?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, logout!'
      }).then((result) => {
        if (result.isConfirmed) {
          document.getElementById('logoutForm').submit();
        }
      });
    });
  </script>
  