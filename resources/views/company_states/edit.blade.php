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
                <h3 class="box-title m-b-0">Editar Datos Del Estado de la empresa</h3>
                <p class="text-muted m-b-30 font-13"> Formulario de actualizacion de datos de el estado de la empresa </p>
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                    {!! Form::model($company_state,[ 'route' => ['company_states.update',$company_state->id],'method' => 'PUT']) !!}
                    @include('company_states.partials.form')
                    {!! Form::close() !!}
                    </div>
                </div>


            </div>
        </div>   
                                 
</div>
@endsection
</div>
