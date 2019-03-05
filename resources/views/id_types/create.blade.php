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
                <h3 class="box-title m-b-0">Crear un  nuevo tipo de identificacion</h3>
                <p class="text-muted m-b-30 font-13"> En este formulario podra crear un nuevo tipo de identificacion, y de esta forma clasificar idos y sus funciones. </p>
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                            {!! Form::open([ 'route' => ['id_types.store'],'method' => 'POST']) !!}
                            @include('id_types.partials.form')
                            {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>   
</div>
</div>                                 
@endsection
