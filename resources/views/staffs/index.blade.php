@extends('layouts.main-layout')

@section('title', 'Staffs')



@section('main-content')
@include('components.breadcrumb', [
  'title' => 'Staffs',
  'items' => [
      ['name' => 'Staffs', 'url' => '#', 'active' => false],
      ['name' => 'Overview', 'url' => '#', 'active' => true],
  ],
  'buttonUrl' => '#', 
  'buttonIcon' => 'bi bi-person-plus',
  'buttonText' => 'Add New Staff' ,
  'buttonType' => '#',
  'buttonmodalId' => '#',
  'buttonModelType'=> '#'
])
{{--  @include('components.Filters')  --}}
{{--  <x-modal visitorsModel='addStaffModalLabel' modalType="staff" />  --}}
{{-- Include the Data Table Component for Visitors --}}
<x-data-table :data="$staffs" type="staffs" />
<script>



@endsection
