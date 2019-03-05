@extends('layouts.app')
@section('content')
@section('css')
    @include('layouts.cssAff')
@endsection

<div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">

@include('layouts.title')

<dashboard-af></dashboard-af>



</div>
</div>

@endsection
