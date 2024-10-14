@extends('layouts.app')

@section('content')
<x-edit-person :person="$person" type="staff" />
@endsection
