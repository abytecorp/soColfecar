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
                <h3 class="box-title m-b-0">Editar Datos Del Plan</h3>
                <p class="text-muted m-b-30 font-13"> Formulario de actualizacion del Plan </p>
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                    {!! Form::model($plan,[ 'route' => ['plans.update',$plan->id],'method' => 'PUT']) !!}
                    @include('plans.partials.formEd')
                    {!! Form::close() !!}
                    </div>
                </div>


            </div>
        </div>   
                                 
</div>
@endsection
</div>
