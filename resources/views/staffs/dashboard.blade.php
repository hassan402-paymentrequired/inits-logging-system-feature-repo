@extends('layouts.staff-layout')
<h2 class="heading">Welcome {{ auth()->user()->name }}</h2>

{{--  {{ dd($currentVisitors) }}  --}}

{{-- Breadcrumb Navigation --}}
<div class="d-flex justify-content-between align-items-center">
<x-breadcrumb title="Dashboard" :items="[
['name' => 'Dashboard', 'url' => '#', 'active' => false],
['name' => 'Home', 'url' => '#', 'active' => true],
]" />


{{--  <x-modal-button visitorsModel='addVisitorModalLabel' modalType="visitor" icon="bi bi-person-plus" />  --}}
</div>

{{--  .blade  --}}
{{--  <x-modal :data="$staffs" visitorsModel='addVisitorModalLabel' modalType="visitor" />   --}}

<div class="d-flex flex-column flex-md-row align-items-center w-100 mb-3">
<small class="text-muted mb-2 mb-md-0 me-md-3">
Visitor/Staffs checkins overview & summary for: 
<span class="text-muted fw-semibold fst-italic"> kdk</small>
</span>
