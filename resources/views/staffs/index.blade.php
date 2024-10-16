@extends('layouts.main-layout')

@section('title', 'Staffs')

@section('main-content')
    <!-- Breadcrumb Component -->
    <div class="d-flex justify-content-between align-items-center">
    <x-breadcrumb title="Staffs" :items="[
        ['name' => 'Staffs', 'url' => '#', 'active' => false],
        ['name' => 'Overview', 'url' => '#', 'active' => true],
    ]" />

    <!-- Modal Button Component -->
    <x-modal-button visitorsModel="addStaffModalLabel" modalType="staff" icon="bi bi-person-plus" />
    </div>
    <!-- Include the Modal for Adding New Staff -->
    <x-modal visitorsModel="addStaffModalLabel" modalType="staff" />

    {{-- Include the Data Table Component for Staffs --}}
    <x-data-table :data="$staffs" type="staffs" />
@endsection
