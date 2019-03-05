@extends('layouts.app')
@section('css')
@include('layouts.cssSel2')
@endsection
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
                <h3 class="box-title m-b-0">Registro de Afiliacion</h3>
                <p class="text-muted m-b-30 font-13"> Formulario de ingreso a nueva empresa </p>
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                    {!! Form::model($company['route' => ['affiliations.update',$company->id], 'method' => 'POST']) !!}
                    @include('affiliations.partials.form')
                    {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>   
                                 

</div>
</div>

@endsection
@section('script')
@include('layouts.scriptSel2')
@endsection
