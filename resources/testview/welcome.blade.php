<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    </head>
    <body class="antialiased">
        @if (session('no_user_found'))
            @error('no_user_found')
                <p>{{ $message }}</p>
            @enderror
        @endif
        <p>{{ session('error')}}</p>

        <form action="/v1/login" method="POST">
            @csrf
            @if (session('error'))
            <div  style="color: black">
                {{ session('error') }}
            </div>
        @endif
            <input type="email" name="email" :value="old('email')" style="border: black">
            <input type="password" name="password" style="border: black">
            <button>submit</button>
        </form>
        <a href="/auth/redirect">google</a>
    </body>
</html>
