@extends('layouts.app')
@section('content')
    <div class="page-wrapper">
        <div class="container-fluid">
            @include('layouts.title')
            <ass-reg :event="{{ $event->id }}"></ass-reg>
        </div>  
    </div>
@endsection