@extends('layouts.app')
@section('content')

<div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">

@include('layouts.title')

<div class="col-12">
        
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ $company_state->company_state }} </h4>
                <h6 class="card-subtitle">{{ $company_state->description ?: 'A este estado no se le asigno ninguna descripcion' }}</h6>
                <div class="table-responsive table-hover">

                </div>
            </div>
        </div>
    </div>
    <!-- column -->




</div>
</div>
@endsection