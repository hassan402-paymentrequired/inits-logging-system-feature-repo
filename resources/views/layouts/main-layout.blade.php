<!-- resources/views/layouts/main-layout.blade.php -->
@extends('layouts.app')

@section('title', $title ?? 'Default Title')

@section('content')
<main class="container mt-2" re>
  @include('layouts.sidebar') <!-- Include Sidebar -->

  <div class="row mb-4">
    @yield('main-content')
  </div>
</main>
@endsection
