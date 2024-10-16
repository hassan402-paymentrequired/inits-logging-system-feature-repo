@extends('layouts.main-layout')

@section('title', 'Visitors')



@section('main-content')
<x-breadcrumb title="Visitors" :items="[
    ['name' => 'Visitors', 'url' => '#', 'active' => false],
    ['name' => 'Overview', 'url' => '#', 'active' => true],
]" />





<x-data-table :data="$visitors_for_the_month" type="visitors" />
<script>
   
    @if (session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: '{{ session('success') }}',
        position: 'top-end',
        timer: 3000,
        timerProgressBar: true,
        showConfirmButton: false
    });
    @endif
  </script>
@endsection
