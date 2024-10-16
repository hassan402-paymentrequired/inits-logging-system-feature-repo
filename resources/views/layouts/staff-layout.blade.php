<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>@yield('title')</title>
</head>
<body>
    <div class="d-flex">
       <!-- Sidebar -->
       <section id="sidebar" class="d-flex flex-column align-items-start">
        <a href="#" class="brand p-2 m-4">
            <img src="{{ asset('build/assets/Logo (1).png') }}" alt="Logo" class="w-75" />
        </a>
        <ul class="side-menu top">
          <x-nav-link href="#" icon="bi-house-door" :active="request()->is('v1/dashboard')">Dashboard</x-nav-link>
          <x-nav-link href="#" icon="bi-people-fill" :active="request()->is('v1/visitors')">Visitors</x-nav-link>
          <x-nav-link href="#" icon="bi-person-workspace" :active="request()->is('v1/profile')">Profile</x-nav-link>
         </ul>
        <ul class="side-menu">
          <li>
            <form id="logoutForm" action="" method="post" style="display: inline;">
              @csrf
              <button id="submitButton" type="button" class="logout btn">
                <i class="bi bi-box-arrow-right text-danger m-2"></i>
                <span class="text-danger m-2">Logout</span>
              </button>
            </form>
          </li>
        </ul>
      </section>
      
        <section id="content" >
            <!-- Content will be inserted here -->
            @yield('content')
        </section>
    </div>
</body>
</html>