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
  'buttonText' => 'Add New Visitor' // Text for adding a new visitor
])
{{--  @include('components.Filters')

@include('components.DataTable', [
  'header' => 'Visitors Data',
  'items' => [
      [
          'name' => 'John Doe',
          'email' => 'john.doe@example.com',
          'host' => 'Jane Smith',
          'purpose' => 'Business Meeting',
          'checkin_time' => '10:00 AM',
          'checkout_time' => '10:00 AM',
      ],
      // Add more visitor data as needed
  ],
  'footerText' => 'Showing 10 items out of 250 results found'
])  --}}
{{-- Include the Data Table Component for Visitors --}}
<x-data-table :data="$visitors_for_the_month" type="visitors" />
@endsection
