@extends('layouts.app')

@section('content')
<x-edit :person="$staff" type="staff" />
@endsection
