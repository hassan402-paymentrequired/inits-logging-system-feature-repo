<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>


<body>
    <div class="container-fluid d-flex min-vh-100 bg-light align-items-center justify-content-center">
        <!-- Form section -->
        <div class="row w-100">
            <div class="col-3 mx-auto">
                <!-- Logo -->
                <div class="text-center mb-4">
                  <img src="{{ asset('build/assets/Logo (1).png') }}" alt="Logo" class="img-fluid w-50">
                </div>
                <!-- Smaller Form -->
                <form id="form" class="border shadow bg-white px-5 py-5" action="{{ route('login') }}" method="POST" style="height: 450px;">
                    @csrf
               
                    <div class="text-center mb-3">
                        <!-- Sign In Title -->
                        <h3 class="mb-3 text-success fw-normal">Sign In</h3>
                        <!-- Icon -->
                        <i class="bi bi-person-fill-lock fs-2 text-primary"></i>
                    </div>

                    <!-- Email field -->
                    <div class="mb-3">
                        <label for="email" class="form-label"><small>Email Address</small></label>
                        <input type="email" id="email" name="email" class="form-control bg-light" value="{{ old('email') }}" placeholder="admin@inits.com" required>
                    
                    </div>

                    <!-- Password field -->
                    <div class="mb-3">
                        <label for="password" class="form-label"><small>Password</small></label>
                        <input type="password" id="password" name="password" class="form-control bg-light" 
                        placeholder="**********"
                         required>
                    </div>

                    <!-- Remember Me checkbox -->
                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="rememberMe" name="rememberMe">
                        <label class="form-check-label fs-sm" for="rememberMe"><small>Remember me</small></label>
                    </div>

                    <!-- Login button -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-dark submitButton fw-semibold shadow-sm w-100" id="submitButton">
                            Sign in
                        </button>
                        <a type="button" href="/auth/redirect" class="btn btn-outline-dark googleButton fw-semibold shadow-sm w-100 mt-1 d-flex align-items-center justify-content-center gap-2" id="googleButton">
                            <img src="{{ asset('build/assets/google (1).png') }}" alt="Logo" class="img-fluid w-5">
                            Sign in 
                        </a>
                    </div>

                    <!-- Error handling -->
                    @if (session('error'))
                    <div class="alert alert-danger mt-2 p-2 d-flex align-items-center justify-content-center">
                        {{ session('error') }}
                    </div>
                @endif
                </form>
            </div>
        </div>
    </div>
</body>
</html>
