@extends('layouts.main-layout')

@section('title', 'Visitors')



@section('main-content')
@include('components.breadcrumb', [
    'title' => 'Visitors',
    'items' => [
        ['name' => 'Visitors', 'url' => '#', 'active' => false],
        ['name' => 'Overview', 'url' => '#', 'active' => true],
    ],
    'buttonUrl' => '#', // Replace with actual URL for adding a new visitor
    'buttonIcon' => 'bi bi-person-plus', // Icon for adding a new visitor
    'buttonText' => 'Add New Visitor',
    'buttonType' => 'modal',
    'buttonmodalId' => '#addVisitorModal',
    'buttonModelType'=> 'visitor'
    // Use the modal ID here
])


{{--  .blade  --}}
<x-modal :data="$staffs" visitorsModel='addVisitorModalLabel' modalType="visitor" />

{{-- Include the Data Table Component for Visitors --}}
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
