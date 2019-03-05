@extends('layouts.app')
@section('content')

<div class="page-wrapper">
    <div class="container-fluid">
@include('layouts.title')

<events-dashboard  :events="{{ $events }}">></events-dashboard>


    </div>  
</div>
@endsection
