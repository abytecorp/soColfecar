@extends('layouts.app')
@section('content')

<div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">

{{-- @include('layouts.title') --}}
<div class="row">
        <div class="col-md-12">
            <div class="card card-body">
                <h3 class="box-title m-b-0">Crear un  nuevo estado de empresa</h3>
                <p class="text-muted m-b-30 font-13"> En este formulario podra crear un nuevo estadin de empresa, y de esta forma clasificar los procesos con las empresas dentro del aplicativo. </p>
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                            {!! Form::open([ 'route' => ['company_states.store'],'method' => 'POST']) !!}
                            @include('company_states.partials.form')
                            {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>   
</div>
</div>                                 
@endsection
