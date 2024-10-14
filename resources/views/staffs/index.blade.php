@extends('layouts.main-layout')

@section('title', 'Staffs')



@section('main-content')
@include('components.breadcrumb', [
  'title' => 'Staffs',
  'items' => [
      ['name' => 'Staffs', 'url' => '#', 'active' => false],
      ['name' => 'Overview', 'url' => '#', 'active' => true],
  ],
  'buttonUrl' => '#', // Replace with actual URL for adding a new visitor
  'buttonIcon' => 'bi bi-person-plus', // Icon for adding a new visitor
  'buttonText' => 'Add New Staff' // Text for adding a new visitor
])
{{--  @include('components.Filters')  --}}

<x-data-table :data="$Staffs_for_the_month" type="staffs" />

@endsection
