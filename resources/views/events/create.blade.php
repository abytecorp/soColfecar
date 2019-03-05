@extends('layouts.app')
{{-- @section('css')
@include('layouts.cssSel2')
@endsection --}}
@section('content')

<div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">

@include('layouts.title')
<div class="row">
        <div class="col-md-12">
            <div class="card card-body">
                <h3 class="box-title m-b-0">Evento Nuevo</h3>
                <p class="text-muted m-b-30 font-13"> En este formulario debe ingresar tosos los datos relevantes del Evento. </p>
                <div class="row">
                    <div class="col-sm-12 col-xs-12">


                        
                            {!! Form::open([ 'route' => ['events.store'],'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                            @include('events.partials.form')
                            {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>   
        <div id="sparkline2dash" class="text-right"></div>
    </div>
</div>
@endsection

{{-- @section('script')

@include('layouts.scriptSel2')
@endsection --}}
