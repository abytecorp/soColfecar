@extends('layouts.appminimenu')
@section('content')

<div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">

@include('layouts.title')

<div class="row">
    <div class="col-12 m-t-30">
        <h1 class="m-b-0"> <strong>PATROCINADORES </strong> </h1>
        <p class="text-muted m-t-0 font-12">Patrocinadores del 43 CONGRESO INTERNACIONAL DE TRANSPORTE DE CARGA Y SU LOGISTICA .</p>
        <div class="card-deck">

            <div class="card">
                <img class="card-img-top img-responsive" src="{{ Storage::disk('public')->url('miniapp/recordar.jpg') }}" alt="Grupo Recordar">
                <div class="card-body">
                    <h4 class="card-title">Grupo Recordar</h4>
                    {{-- <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p> --}}
                    {{-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> --}}
                </div>
            </div>

            <div class="card">
                <img class="card-img-top img-responsive" src="{{ Storage::disk('public')->url('miniapp/spb.jpg') }}" alt="Sociedad Portuaria de Buenaventura">
                <div class="card-body">
                    <h4 class="card-title">Sociedad Portuaria de Buenaventura</h4>
                    {{-- <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p> --}}
                    {{-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> --}}
                </div>
            </div>

            <div class="card">
                <img class="card-img-top img-responsive" src="{{ Storage::disk('public')->url('miniapp/oet.jpg') }}" alt="Grupo OET">
                <div class="card-body">
                    <h4 class="card-title">Grupo OET</h4>
                    {{-- <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p> --}}
                    {{-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> --}}
                </div>
            </div>

            <div class="card">
                <img class="card-img-top img-responsive" src="{{ Storage::disk('public')->url('miniapp/biomax.jpg') }}" alt="BIOMAX">
                <div class="card-body">
                    <h4 class="card-title">BIOMAX</h4>
                    {{-- <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p> --}}
                    {{-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> --}}
                </div>
            </div>

            <div class="card">
                <img class="card-img-top img-responsive" src="{{ Storage::disk('public')->url('miniapp/uno.jpg') }}" alt="UNO Lubricantes">
                <div class="card-body">
                    <h4 class="card-title">UNO Lubricantes</h4>
                    {{-- <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p> --}}
                    {{-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> --}}
                </div>
            </div>

            <div class="card">
                <img class="card-img-top img-responsive" src="{{ Storage::disk('public')->url('miniapp/wizeo.jpg') }}" alt="Sodexo Wizeo">
                <div class="card-body">
                    <h4 class="card-title">Sodexo Wizeo</h4>
                    {{-- <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p> --}}
                    {{-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> --}}
                </div>
            </div>
            
        </div>
    </div>

</div>
<hr>
<div class="row el-element-overlay">
                <div class="col-md-12">
   
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="el-card-item">
                                <a href="{{ route('planofull.miniapp') }}">
                            <div class="el-card-avatar el-overlay-1"> <img src="{{ Storage::disk('public')->url('miniapp/map.jpg') }}" alt="user" />
                                <div class="el-overlay">
                                    <ul class="el-info">
                                        
                                    </ul>
                                </div>
                            </div></a>
                            <div class="el-card-content">
                                <h3 class="box-title">Plano</h3> <small>Muestra comercial</small>
                                <br/> </div>
                        </div>
                    </div>
                </div>
                            </div>


@endsection
