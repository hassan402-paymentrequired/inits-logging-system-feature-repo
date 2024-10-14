@extends('layouts.app')

@section('content')
<x-edit :person="$visitor" type="visitor" />
@endsection
